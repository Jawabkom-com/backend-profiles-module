<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchOnlineBySearchersChain extends AbstractService
{
    protected IProfileRepository $repository;
    private SearcherRegistry $registry;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository, SearcherRegistry $registry)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->registry = $registry;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        foreach($aliases as $alias) {
            $searcher = $this->registry->getSearcher($alias);
            $results = $searcher->search($filters);
            if($results) {
                $mapper = $this->registry->getMapper($alias);
                return $mapper->map($results);
            }
        }
        return $this;
    }

}