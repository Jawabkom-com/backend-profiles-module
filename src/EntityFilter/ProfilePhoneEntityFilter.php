<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfilePhoneEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ProfilePhoneEntityFilter implements IProfilePhoneEntityFilter
{

    protected IDependencyInjector $di;

    public function __construct(IDependencyInjector $di)
    {
        $this->di = $di;
    }

    public function filter(IProfilePhoneEntity $entity): void
    {
        $entity->setPossibleCountries(array_map(function ($value) {
            return strtoupper($value);
        }, $entity->getPossibleCountries()??[] ));

        if ($entity->getOriginalNumber()) {
            $countries = $entity->getPossibleCountries()??[];
            array_unshift($countries, $entity->getCountryCode());
            $phone = $this->di->make(Phone::class);
            $phoneParseResult = $phone->parse($entity->getOriginalNumber(), $countries);

            $entity->setFormattedNumber($phoneParseResult['phone']);
            $entity->setValidPhone($phoneParseResult['is_valid']);
            $entity->setCountryCode($phoneParseResult['country_code']);
        }
    }
}
