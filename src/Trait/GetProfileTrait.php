<?php

namespace Jawabkom\Backend\Module\Profile\Trait;


use Jawabkom\Backend\Module\Profile\Exception\FilterNameDoesNotExistsException;

trait GetProfileTrait
{
    protected  array $filterNames = ['name'];

    //
    // LEVEL 1
    //

    protected function validateFilters(array $filtersInput)
    {
        if(!empty($filtersInput)){
            foreach($filtersInput as $filterName => $filterValue) {
                if(!in_array($filterName, $this->filterNames)) {
                    throw new FilterNameDoesNotExistsException("Filter name [{$filterName}]");
                }
            }
        }

    }

}
