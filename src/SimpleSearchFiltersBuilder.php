<?php

namespace Jawabkom\Backend\Module\Profile;

use Jawabkom\Backend\Module\Profile\Contract\ISearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Exception\FilterLogicalOperationDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\FilterNameDoesNotExistsException;
use Jawabkom\Standard\Contract\IAndFilterComposite;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IFilter;
use Jawabkom\Standard\Contract\IFilterComposite;
use Jawabkom\Standard\Contract\IOrFilterComposite;

class SimpleSearchFiltersBuilder implements ISearchFiltersBuilder
{
    protected array $registeredFilters = ['first_name', 'last_name', 'middle_name', 'raw_name', 'phone', 'email', 'country_code', 'city', 'state', 'age', 'username'];
    protected array $filters;
    protected string $filterType = 'and';

    private IDependencyInjector $di;

    public function __construct(IDependencyInjector $di)
    {
        $this->di = $di;
    }

    public function registerFilter(string $filterName):static
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

    public function trim(array $only = []):static
    {
        if(!$this->filters) {
            throw new \Exception('Please set the filters first before calling this method');
        }
        if(empty($only)) {
            $only = $this->registeredFilters;
        }
        foreach($this->filters as $filterName => $filterValue) {
            if(in_array($filterName, $only)) {
                if(is_string($filterValue)) {
                    $this->filters[$filterName] = trim($filterValue);
                }
            }
        }
        return $this;
    }

    public function build(): IFilterComposite
    {
        if($this->filterType == 'or') {
            return $this->di->make(IOrFilterComposite::class);
        } elseif($this->filterType == 'and') {
            $compositeAndFilter = $this->di->make(IAndFilterComposite::class);
            foreach ($this->filters as $filterName => $filterValue) {
                $filterObj = $this->di->make(IFilter::class);
                $compositeAndFilter->addChild($filterObj->setName($filterName)->setValue($filterValue));
            }
            return $compositeAndFilter;
        }

        throw new FilterLogicalOperationDoesNotExists("Operation: '{$this->filterType}'");
    }

    public function buildAsArray():array
    {
        $toReturn[$this->filterType] = [];
        foreach($this->registeredFilters as $registeredFilter) {
            if(isset($this->filters[$registeredFilter])) {
                $toReturn[$this->filterType][$registeredFilter] = $this->filters[$registeredFilter];
            }
        }
        return $toReturn;
    }


    protected function validateFilters(array $filters)
    {
        foreach($filters as $filterName => $value)
        {
            if(!in_array($filterName, $this->registeredFilters)) {
                throw new FilterNameDoesNotExistsException("Filter Name: '$filterName', Allowed Filters: ".json_encode($this->registeredFilters));
            }
        }
    }
}
