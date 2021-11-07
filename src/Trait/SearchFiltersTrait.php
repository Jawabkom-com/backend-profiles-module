<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\CountryCodeFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\EmailFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\NameFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\PhoneNumberFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\UserNameFilter;
use Jawabkom\Backend\Module\Profile\Validator\SearchFiltersInputValidator;

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

    /**
     * @param mixed $inputFilters
     * @param array $searchFilters
     * @return array
     */
    protected function getSearchFilters(iterable $inputFilters): array
    {
        $searchFilters = [];
        foreach ($inputFilters as $inputFilterName => $inputFilterValue) {
            switch ($inputFilterName) {
                case 'phone':
                    $formattedPhone  = $this->phone->parse($inputFilterValue)['phone'];
                    $searchFilters[] = $this->di->make(PhoneNumberFilter::class,['phone'=>$formattedPhone]);
                    break;
                case 'username':
                    $searchFilters[] = $this->di->make(UserNameFilter::class,['userName'=>$inputFilterValue]);
                    break;
                case 'email':
                    $searchFilters[] = $this->di->make(EmailFilter::class,['email'=>$inputFilterValue]);
                    break;
                case 'name':
                    $searchFilters[] = $this->di->make(NameFilter::class,['name'=>$inputFilterValue]);
                    break;
                case 'country_code':
                    $searchFilters[] = $this->di->make(CountryCodeFilter::class,['countryCode'=>$inputFilterValue]);
                    break;
            }
        }
        return $searchFilters;
    }

    private function validateFilterInputs(array $inputFilters)
    {
        $validator = $this->di->make(SearchFiltersInputValidator::class);
        $validator->validate($inputFilters);
    }

}
