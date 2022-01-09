<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;
use Jawabkom\Backend\Module\Profile\Library\Phone;

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
            if(str_contains($oPhone->getFormattedNumber(), $this->normalizedPhoneNumber)) {
                return true;
            }
        }
        return false;
    }
}