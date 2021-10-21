<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSearcher;
use Jawabkom\Backend\Module\Profile\Contract\ISearcherStatusRepository;
use Jawabkom\Backend\Module\Profile\Contract\ISearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestRepository;
use Jawabkom\Backend\Module\Profile\Exception\SearcherExceededAllowedRequestsLimit;
use Jawabkom\Backend\Module\Profile\Exception\SearcherRegistryDoesNotExist;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\Trait\ProfileHashTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchOnlineBySearchersChain extends AbstractService
{
    use  ProfileHashTrait;

    protected IProfileRepository $repository;
    private SearcherRegistry $registry;
    private ISearchFiltersBuilder $searchFiltersBuilder;
    private ISearchRequestRepository $searchRequestRepository;
    private ISearcherStatusRepository $searcherStatusRepository;
    private \DateTime $currentDateTime;

    public function __construct(IDependencyInjector       $di,
                                IProfileRepository        $repository,
                                SearcherRegistry          $registry,
                                ISearchFiltersBuilder     $searchFiltersBuilder,
                                ISearchRequestRepository  $searchRequestRepository,
                                ISearcherStatusRepository $searcherStatusRepository,
                                \DateTime                 $currentDateTime
    )
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->registry = $registry;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
        $this->searchRequestRepository = $searchRequestRepository;
        $this->searcherStatusRepository = $searcherStatusRepository;
        $this->currentDateTime = $currentDateTime;
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
                $results = $this->getSearchResults($isFromCache, $alias, $cachedResultsByAliases);

                $profileEntities = $this->mapResultsToProfileEntities($alias, $results);
                if (count($profileEntities)) {
                    //if (!$isFromCache)
                    $this->saveResultsMappedProfile($profileEntities, $alias);
                    $this->setSucceededSearchRequestStatus($searchRequest, $results, count($profileEntities));
                    $this->setOutput('result', $profileEntities);
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
        $searchRequest->setMatchesCount(0);
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
        $searchRequest->addError("Time: " . date('Y-m-d H:i:s') . ", File: {$exception->getFile()}, Line: {$exception->getLine()}, Message: {$exception->getMessage()}, Type: " . get_class($exception));
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


    protected function assertSearcherLimit(IProfileSearcher $searcher, string $alias)
    {
        $this->perHourlyCheck($searcher, $alias);
        $this->perDailyCheck($searcher, $alias);
        $this->perMonthlyCheck($searcher, $alias);
    }

    private function updateSearcherSearchLimit(string $alias)
    {
        $checkSearcherCreated = $this->searcherStatusRepository->getSearcherRequests($alias, $this->currentDateTime->format('Y'), $this->currentDateTime->format('m'), $this->currentDateTime->format('d'), $this->currentDateTime->format('H'));
        if (empty($checkSearcherCreated)) {
            $SearcherObj = $this->createNewSearcherObj($alias);
            $this->searcherStatusRepository->saveEntity($SearcherObj);
        } else {
            $this->searcherStatusRepository->increaseSearcherRequestsCount($alias, $this->currentDateTime->format('Y'), $this->currentDateTime->format('m'), $this->currentDateTime->format('d'), $this->currentDateTime->format('H'));
        }
    }

    //
    // LEVEL 2
    //

    protected function perHourlyCheck(IProfileSearcher $searcher, string $alias)
    {
        $perHourCount = $this->getSearcherRequestsCount($alias, $this->currentDateTime->format('Y'), $this->currentDateTime->format('m'), $this->currentDateTime->format('d'), $this->currentDateTime->format('H'));
        if ($perHourCount >= $searcher->getHourlyRequestsLimit() && $searcher->getHourlyRequestsLimit() != 0) {
            throw new SearcherExceededAllowedRequestsLimit("Searcher Exceeded Limit");
        }

    }

    protected function perDailyCheck(IProfileSearcher $searcher, string $alias)
    {
        $perDayCount = $this->getSearcherRequestsCount($alias, $this->currentDateTime->format('Y'), $this->currentDateTime->format('m'), $this->currentDateTime->format('d'), null);
        if ($perDayCount >= $searcher->getDailyRequestsLimit() && $searcher->getDailyRequestsLimit() != 0) {
            throw new SearcherExceededAllowedRequestsLimit("Searcher Exceeded Limit");
        }
    }

    protected function perMonthlyCheck(IProfileSearcher $searcher, string $alias)
    {
        $perMonthCount = $this->getSearcherRequestsCount($alias, $this->currentDateTime->format('Y'), $this->currentDateTime->format('m'), 0, null);
        if ($perMonthCount >= $searcher->getMonthlyRequestsLimit() && $searcher->getMonthlyRequestsLimit() != 0) {
            throw new SearcherExceededAllowedRequestsLimit("Searcher Exceeded Limit");
        }
    }

    private function createNewSearcherObj($alias)
    {
        $searcherStatusEntity = $this->searcherStatusRepository->createEntity();
        $searcherStatusEntity->setStatusHour($this->currentDateTime->format('H'));
        $searcherStatusEntity->setStatusDay($this->currentDateTime->format('d'));
        $searcherStatusEntity->setStatusMonth($this->currentDateTime->format('m'));
        $searcherStatusEntity->setStatusYear($this->currentDateTime->format('Y'));
        $searcherStatusEntity->setSearcherAlias($alias);
        $searcherStatusEntity->setCounter(1);
        return $searcherStatusEntity;
    }

    //
    // LEVEL 3
    //
    protected function getSearcherRequestsCount($alias, $year, $month, $day, $hour)
    {
        return $this->searcherStatusRepository
            ->getSearcherRequestsCount($alias, $year, $month, $day, $hour);
    }

    protected function getSearchResults(bool $isFromCache, mixed $alias, $cachedResultsByAliases): mixed
    {
        if (!$isFromCache) {
            $searcher = $this->registry->getSearcher($alias);
            $this->assertSearcherLimit($searcher, $alias);
            $results = $searcher->search($this->searchFiltersBuilder->build());
            $this->updateSearcherSearchLimit($alias);
        } else {
            $results = $cachedResultsByAliases[$alias];
        }
        return $results;
    }

    protected function mapResultsToProfileEntities(mixed $alias, mixed $results): iterable
    {
        $mapper = $this->registry->getMapper($alias);
        $profileEntities = $mapper->map($results);
        return $profileEntities;
    }

    protected function saveResultsMappedProfile(iterable $profileEntities, mixed $alias): void
    {
        foreach ($profileEntities as $profileEntity) {
            $profileEntity->setDataSource($alias);
            $this->setProfileHash($profileEntity);
            if( !$this->repository->hashExist($profileEntity->getHash()) )
                $this->repository->saveEntity($profileEntity);
        }
    }

}
