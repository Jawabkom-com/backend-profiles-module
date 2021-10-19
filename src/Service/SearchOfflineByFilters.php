<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Trait\GetProfileTrait;
use Jawabkom\Backend\Module\Profile\Trait\ResponseFormattedTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByFilters extends AbstractService
{
    use ResponseFormattedTrait;
    protected IProfileRepository $repository;
    private SimpleSearchFiltersBuilder $searchFiltersBuilder;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository, SimpleSearchFiltersBuilder $searchFiltersBuilder)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $orderByInput = $this->getInput('orderBy', []);
        $page = $this->getInput('page', 1);
        $perPage = $this->getInput('perPage', 0);
        $filtersInput = $this->getInput('filters', []);
        $this->validate($filtersInput);
        $compositeFilters = $this->searchFiltersBuilder->setAllFilters($this->getInput('filters'))->build();
        $results   = $this->repository->getByFilters($compositeFilters);
        $response = $this->formattedResponse($results);
        $this->setOutput('response',$response);
        return $this;
    }

    private function validate(mixed $filtersInput)
    {
        if (empty($filtersInput)){
            throw new MissingRequiredInputException('Missing Filter');
        }
    }


}
