<?php

namespace Jawabkom\Backend\Module\Profile\Service\SearchOffline;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IQueryRequestLoggerEntity;
use Jawabkom\Backend\Module\Profile\Contract\IQueryRequestLoggerRepository;
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByFilters extends AbstractService
{
    protected IProfileRepository $repository;
    private SimpleSearchFiltersBuilder $searchFiltersBuilder;
    private IQueryRequestLoggerRepository $queryRequestLoggerRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileRepository $repository,
                                IQueryRequestLoggerRepository $queryRequestLoggerRepository,
                                SimpleSearchFiltersBuilder $searchFiltersBuilder)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
        $this->queryRequestLoggerRepository = $queryRequestLoggerRepository;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $filtersInput = $this->getInput('filters', []);
        $this->validate($filtersInput);
        $compositeFilters = $this->searchFiltersBuilder->setAllFilters($filtersInput)->build();
        $queryRequestLogger = $this->logInitRequest();
        try {
            $results = $this->repository->getByFilters($compositeFilters);
            $profileComposites = $this->formattedToProfileComposite($results);
            ($count = count($profileComposites))>0?$this->setSucceededRequestStatus($queryRequestLogger,$count):$this->setEmptySearchRequestStatus($queryRequestLogger);
            $this->setOutput('result', $profileComposites);
        }catch (\Throwable $exception){
            if (!isset($requestLogger))
                throw $exception;
            $this->setErrorSearchRequestStatus($queryRequestLogger,$exception);
        }
        return $this;
    }

    private function validate(mixed $filtersInput)
    {
        if (empty($filtersInput)){
            throw new MissingRequiredInputException('Missing Filter');
        }
    }

    /**
     * @param iterable|array $results
     */
    protected function formattedToProfileComposite(iterable $results):Iterable
    {
        $profileComposites = [];
        $profileCompositeFacade = $this->di->make(IProfileCompositeFacade::class);
        foreach ($results as $result) {
            $profileComposites[] = $profileCompositeFacade->getCompositeByProfileId($result->getProfileId());
        }
        return $profileComposites;
    }

    protected function logInitRequest(): IQueryRequestLoggerEntity
    {
        $loggerRequest = $this->queryRequestLoggerRepository->createEntity();
        $loggerRequest->setRequestFilters($this->getInput('filters',[]));
        $loggerRequest->setRequestDateTime(new \DateTime());
        $loggerRequest->setOtherParams($this->getInput('request_Meta',[]));
        $loggerRequest->setStatus('init');
        $loggerRequest->setMatchesCount(0);
        $this->queryRequestLoggerRepository->saveEntity($loggerRequest);
        return $loggerRequest;
    }

    protected function setSucceededRequestStatus(IQueryRequestLoggerEntity $loggerEntity, int $matches): void
    {
        $loggerEntity->setMatchesCount($matches);
        $loggerEntity->setStatus('done');
        $this->queryRequestLoggerRepository->saveEntity($loggerEntity);
    }

    protected function setEmptySearchRequestStatus(IQueryRequestLoggerEntity $searchRequest): void
    {
        $this->setSucceededRequestStatus($searchRequest, 0);
    }

    protected function setErrorSearchRequestStatus(IQueryRequestLoggerEntity $searchRequest, \Throwable $exception): void
    {
        $searchRequest->setMatchesCount(0);
        $searchRequest->setStatus('error');
        $searchRequest->addError("Time: " . date('Y-m-d H:i:s') . ", File: {$exception->getFile()}, Line: {$exception->getLine()}, Message: {$exception->getMessage()}, Type: " . get_class($exception));
        $this->queryRequestLoggerRepository->saveEntity($searchRequest);
    }
}
