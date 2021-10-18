<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSearcher;
use Jawabkom\Backend\Module\Profile\Contract\ISearcherStatusRepository;
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
    private ISearcherStatusRepository $searcherStatusRepository;

    public function __construct(IDependencyInjector      $di,
                                IProfileRepository       $repository,
                                SearcherRegistry         $registry,
                                ISearchFiltersBuilder    $searchFiltersBuilder,
                                ISearchRequestRepository $searchRequestRepository,
                                ISearcherStatusRepository $searcherStatusRepository,
    )
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->registry = $registry;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
        $this->searchRequestRepository = $searchRequestRepository;
        $this->searcherStatusRepository = $searcherStatusRepository;
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
        $searchRequests = [];

        foreach ($searchersAliases as $alias) {

            try {
                // check if there's a result in the cache
                $isFromCache = isset($cachedResultsByAliases[$alias]);
                $searchRequest = null; // reset the search request for each alias
                $searchRequests[] = $searchRequest = $this->initSearchRequest($searchGroupHash, $alias, $isFromCache);
                if (!$isFromCache) {
                    $searcher = $this->registry->getSearcher($alias);
                    // TODO: check search limits, and throw exception
                    $this->assertSearcherLimit($searcher,$alias);

                    $results = $searcher->search($this->searchFiltersBuilder->build());
                    // TODO: update searcher search limit
                } else {
                    $results = $cachedResultsByAliases[$alias];
                }

                $mapper = $this->registry->getMapper($alias);
                $profileEntities = $mapper->map($results);
                if (count($profileEntities)) {
                    if (!$isFromCache)
                        foreach ($profileEntities as $profileEntity) {
                            $profileEntity->setDataSource($alias);
                            $this->repository->saveEntity($profileEntity);
                        }
                    $this->setSucceededSearchRequestStatus($searchRequest, $results, count($profileEntities));
                    $this->setOutput('profiles', $profileEntities);
                    $this->setOutput('raw_result', $results);
                    break;
                } else {
                    $this->setEmptySearchRequestStatus($searchRequest, $results);
                }
            } catch (\Throwable $exception) {
                if (!isset($searchRequest))
                    throw $exception;

                $this->setErrorSearchRequestStatus($searchRequest, $exception);
            }
        }
        $this->setOutput('search_requests', $searchRequests);
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

    protected function setEmptySearchRequestStatus(ISearchRequestEntity $searchRequest, mixed $results): void
    {
        $this->setSucceededSearchRequestStatus($searchRequest, $results, 0);
    }

    protected function setErrorSearchRequestStatus(ISearchRequestEntity $searchRequest, \Throwable $exception): void
    {
        $searchRequest->setMatchesCount(0);
        $searchRequest->setStatus('error');
        $searchRequest->setRequestSearchResults([]);
        $searchRequest->addError("Time: " . date('Y-m-d H:i:s') . ", File: {$exception->getFile()}, Line: {$exception->getLine()}, Message: {$exception->getMessage()}");
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

    private function assertSearcherLimit(IProfileSearcher $searcher , string $alias)
    {
        $profileEntity = $this->searcherStatusRepository->createEntity();
        $profileEntity->setSearcherAlias($alias);
        $profileEntity->setCounter(1);
        $profileEntity->setStatusDay(1);
        $profileEntity->setStatusMonth(2);
        $profileEntity->setStatusYear(2021);
        $this->searcherStatusRepository->saveEntity($profileEntity);
        dd($profileEntity);
     //   dd( $this->searcherStatusRepository->saveEntity($profileEntity));
//
//        $this->searcherStatusRepository->getSearcherRequestsCount($alias,date('Y'),1,1,1);
//        return;
//        dd($alias);
//        dd($searcher->getDailyRequestsLimit());
    }

}
