<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Exception\SearcherRegistryDoesNotExist;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchOnlineBySearchersChain extends AbstractService
{
    protected IProfileRepository $repository;
    private SearcherRegistry $registry;
    private SearchFiltersBuilder $searchFiltersBuilder;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository, SearcherRegistry $registry, SearchFiltersBuilder $searchFiltersBuilder)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->registry = $registry;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $filter = $this->getInput('filter');
        $searchersAliases = $this->getInput('searchersAliases', []);

        foreach($searchersAliases as $alias) {
            $searcher = $this->registry->getSearcher($alias);
            if(!$searcher) {
                throw new SearcherRegistryDoesNotExist("Alias: {$alias}");
            }
            $results = $searcher->search($filter);

            if($results) {
                $mapper = $this->registry->getMapper($alias);
                $profileEntities = $mapper->map($results);

            }
        }
        return $this;
    }

}