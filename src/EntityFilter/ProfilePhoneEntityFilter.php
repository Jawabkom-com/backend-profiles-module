<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfilePhoneEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;

class ProfilePhoneEntityFilter implements IProfilePhoneEntityFilter
{

    public function filter(IProfilePhoneEntity $entity): void
    {
        if($entity->getCountryCode()) $entity->setCountryCode(strtoupper($entity->getCountryCode()));

    }
}
