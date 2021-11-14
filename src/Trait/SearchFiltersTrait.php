<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;
use Jawabkom\Backend\Module\Profile\Exception\InvalidFilterException;

trait SearchFiltersTrait
{
    /**
     * @param IProfileCompositeSearchFilter[] $filters
     * @param IProfileComposite[] $composite
     */
    protected function applySearchFilters(array $filters, array $composites): array
    {
        $filteredComposites = [];
        foreach($composites as $composite) {
            $filterResult = true;
            foreach ($filters as $filter) {
                if (!($filter instanceof IProfileCompositeSearchFilter)){
                    throw new InvalidFilterException('Invalid filter type');
                }
                if(!$filter->apply($composite)) {
                    $filterResult = false;
                    break;
                }
            }
            if($filterResult) {
                $filteredComposites[] = $composite;
            }
        }
        return $filteredComposites;
    }
}
