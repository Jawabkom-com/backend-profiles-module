<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfilePhoneEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
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
        if ($entity->getOriginalNumber()){
           $phone = $this->di->make(Phone::class);
           $phoneParseResult = $phone->parse($entity->getOriginalNumber(),$entity->getPossibleCountries());
            $entity->setOriginalNumber($phoneParseResult['phone']);
            $entity->setValidPhone($phoneParseResult['is_valid']);
            $entity->setCountryCode($phoneParseResult['country_code']);
        }

        if($entity->getCountryCode()) $entity->setCountryCode(strtoupper($entity->getCountryCode()));

        $entity->setPossibleCountries(array_map(function($value) { return strtoupper($value);  }, $entity->getPossibleCountries()));

    }
}
