<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class CountryCodeFilter implements IProfileCompositeSearchFilter
{


    private string $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function apply(IProfileComposite $composite): bool
    {
        foreach($composite->getPhones() as $phone) {
            if($phone->getCountryCode() == $this->countryCode) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

}