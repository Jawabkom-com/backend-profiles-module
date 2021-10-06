<?php

namespace Jawabkom\Backend\Module\Profile;

use Jawabkom\Backend\Module\Profile\Exception\FilterLogicalOperationDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\FilterNameDoesNotExistsException;
use Jawabkom\Standard\Contract\IAndFilterComposite;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IFilterComposite;
use Jawabkom\Standard\Contract\IOrFilterComposite;

class SearchFiltersBuilder
{
    protected array $registeredFilters = ['first_name', 'last_name', 'middle_name', 'raw_name', 'phone', 'email', 'country_code', 'city', 'state', 'age', 'username'];
    protected array $filters;
    protected string $filterType = 'and';

    private IDependencyInjector $di;

    public function __construct(IDependencyInjector $di)
    {
        $this->di = $di;
    }

    public function registerFilter($filterName):static
    {
        if(!in_array($filterName, $this->registeredFilters)) {
            $this->registeredFilters[] = $filterName;
        }
        return $this;
    }

    public function setAllFilters(array $filters):static
    {
        $this->validateFilters($filters);
        $this->filters = $filters;
        return $this;
    }

    public function setFilterType($type = 'and'):static
    {
        $this->filterType = $type;
        return $this;
    }

    protected function validateFilters(array $filters)
    {
        foreach($filters as $filterName => $value)
        {
            if(!in_array($filterName, $this->registeredFilters)) {
                throw new FilterNameDoesNotExistsException("Filter Name: '$filterName'");
            }
        }
    }

    public function build(): IFilterComposite
    {
        if($this->filterType == 'or') {
            return $this->di->make(IOrFilterComposite::class);
        } elseif($this->filterType == 'or') {
            return $this->di->make(IAndFilterComposite::class);
        }

        throw new FilterLogicalOperationDoesNotExists("Operation: '{$this->filterType}'");
    }

}