<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\ISearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestRepository;
use Jawabkom\Backend\Module\Profile\Exception\SearcherRegistryDoesNotExist;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchOnlineBySearchersChain extends AbstractService
{
    protected IProfileRepository $repository;
    private SearcherRegistry $registry;
    private ISearchFiltersBuilder $searchFiltersBuilder;
    private ISearchRequestRepository $searchRequestRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileRepository $repository,
                                SearcherRegistry $registry,
                                ISearchFiltersBuilder $searchFiltersBuilder,
                                ISearchRequestRepository $searchRequestRepository)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->registry = $registry;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
        $this->searchRequestRepository = $searchRequestRepository;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $filter = $this->getInput('filters');
        $searchersAliases = $this->getInput('searchersAliases', []);
        $this->validateSearchersChain($searchersAliases);
        $this->searchFiltersBuilder->setAllFilters($filter)->trim();
        $searchGroupHash = sha1(json_encode($this->searchFiltersBuilder->buildAsArray()));
        $cachedResultsByAliases = $this->getCachedResultsByAliases($searchGroupHash);
        foreach($searchersAliases as $alias) {
            try {
                // check if there's a result in the cache
                if(!isset($cachedResultsByAliases[$alias])) {
                    $searchRequest = $this->initSearchRequest($searchGroupHash, $alias, false);
                    $searcher = $this->registry->getSearcher($alias);
                    $results = $searcher->search($this->searchFiltersBuilder->build());
                } else {
                    $searchRequest = $this->initSearchRequest($searchGroupHash, $alias, true);
                    $results = $cachedResultsByAliases[$alias];
                }

                $mapper = $this->registry->getMapper($alias);
                $profileEntities = $mapper->map($results);
                if(count($profileEntities)) {
                    $this->setOutput('profiles', $profileEntities);
                    $this->setOutput('raw_result', $results);

                    foreach($profileEntities as $profileEntity) {
                        $this->repository->saveEntity($profileEntity);
                    }

                    $this->setSucceededSearchRequestStatus($searchRequest, $results, count($profileEntities));
                    break;
                } else {
                    $this->setEmptySearchRequestStatus($searchRequest);
                }
            } catch (\Throwable $exception) {
                if(!isset($searchRequest))
                    throw $exception;

                $this->setErrorSearchRequestStatus($searchRequest, $exception);
            }
        }
        return $this;
    }

    //
    // LEVEL 1
    //
    protected function validateSearchersChain(mixed $searchersAliases): void
    {
        foreach ($searchersAliases as $alias) {
            if (!$this->registry->isRegistered($alias)) {
                throw new SearcherRegistryDoesNotExist("Alias: {$alias}");
            }
        }
    }

    protected function initSearchRequest(string $searchGroupHash, string $alias, bool $isFromCache = false): ISearchRequestEntity
    {
        $searchRequest = $this->searchRequestRepository->createEntity();
        $searchRequest->setHash($searchGroupHash);
        $searchRequest->setResultAliasSource($alias);
        $searchRequest->setRequestSearchFilters($this->getInput('filters', []));
        $searchRequest->setRequestDateTime(new \DateTime());
        $searchRequest->setOtherParams($this->getInput('requestMeta', []));
        $searchRequest->setStatus('init');
        $searchRequest->setIsFromCache($isFromCache);
        $this->searchRequestRepository->saveEntity($searchRequest);
        return $searchRequest;
    }

    protected function setSucceededSearchRequestStatus(ISearchRequestEntity $searchRequest, mixed $results, int $matches): void
    {
        $searchRequest->setMatchesCount($matches);
        $searchRequest->setStatus('done');
        $searchRequest->setRequestSearchResults($results);
        $this->searchRequestRepository->saveEntity($searchRequest);
    }

    protected function setEmptySearchRequestStatus(ISearchRequestEntity $searchRequest): void
    {
        $this->setSucceededSearchRequestStatus($searchRequest, [], 0);
    }

    protected function setErrorSearchRequestStatus(ISearchRequestEntity $searchRequest, \Throwable $exception):void{
        $searchRequest->setMatchesCount(0);
        $searchRequest->setStatus('error');
        $searchRequest->setRequestSearchResults([]);
        $searchRequest->addError("Time: ".date('Y-m-d H:i:s').", File: {$exception->getFile()}, Line: {$exception->getLine()}, Message: {$exception->getMessage()}");
        $this->searchRequestRepository->saveEntity($searchRequest);
    }

    protected function getCachedResultsByAliases(string $searchGroupHash): array
    {
        $cachedResultsByAliases = [];
        $cachedResults = $this->searchRequestRepository->getByHash($searchGroupHash, 'done', false);
        if ($cachedResults) {
            foreach ($cachedResults as $cachedResult) {
                $cachedResultsByAliases[$cachedResult->getResultAliasSource()] = $cachedResult->getRequestSearchResults();
            }
        }
        return $cachedResultsByAliases;
    }

}