<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Trait\GetProfileTrait;
use Jawabkom\Backend\Module\Profile\Trait\ResponseFormattedTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;
use phpDocumentor\Reflection\Types\Iterable_;

class SearchOfflineByFilters extends AbstractService
{
    protected IProfileRepository $repository;
    private SimpleSearchFiltersBuilder $searchFiltersBuilder;

    public function __construct(IDependencyInjector $di,
                                IProfileRepository $repository,
                                SimpleSearchFiltersBuilder $searchFiltersBuilder)
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
        $compositeFilters  = $this->searchFiltersBuilder->setAllFilters($this->getInput('filters'))->build();
        $results           = $this->repository->getByFilters($compositeFilters);
        $profileComposites = $this->formattedToProfileComposite($results);
        $this->setOutput('result',$profileComposites);
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


}
