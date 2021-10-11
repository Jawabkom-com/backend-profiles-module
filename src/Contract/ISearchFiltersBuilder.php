<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IFilterComposite;

interface ISearchFiltersBuilder
{

    public function registerFilter(string $filterName):static;

    public function setAllFilters(array $filters):static;

    public function setFilterType(string $type = 'and'):static;

    /**
     * @param array $only to add the filter names you want to trim, keep it empty in case you want to trim all the filters
     * @return $this
     */
    public function trim(array $only = []):static;

    public function build(): IFilterComposite;

    public function buildAsArray():array;

}
