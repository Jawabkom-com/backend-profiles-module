<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class PhoneNumberFilter implements IProfileCompositeSearchFilter
{
    protected string $normalizedPhoneNumber;

    public function __construct(string $normalizedPhoneNumber)
    {
        $this->normalizedPhoneNumber = $normalizedPhoneNumber;
    }

    public function apply(IProfileComposite $composite): bool
    {
        foreach($composite->getPhones() as $oPhone) {
            if($oPhone->getFormattedNumber() == $this->normalizedPhoneNumber) {
                return true;
            }
        }
        return false;
    }
}