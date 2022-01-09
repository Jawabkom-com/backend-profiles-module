<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class CountryCodeFilter implements IProfileCompositeSearchFilter
{


    private string $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = trim(strtoupper($countryCode));
    }

    public function apply(IProfileComposite $composite): bool
    {
        //
        // search phones
        //
        foreach($composite->getPhones() as $phone) {
            if($phone->getCountryCode() == $this->countryCode) {
                return true;
            }
        }

        //
        // search addresses
        //
        foreach($composite->getAddresses() as $address) {
            if($address->getCountry() == $this->countryCode) {
                return true;
            }
        }
        return false;
    }
}