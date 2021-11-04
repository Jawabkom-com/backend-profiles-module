<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class PhoneNumberFilter implements IProfileCompositeSearchFilter
{
    protected string $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function apply(IProfileComposite $composite): bool
    {
        foreach($composite->getPhones() as $oPhone) {
            if($oPhone->getFormattedNumber() == $this->phoneNumber) {
                return true;
            }
        }
        return false;
    }
}