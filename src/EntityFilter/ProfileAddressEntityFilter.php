<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileAddressEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;

class ProfileAddressEntityFilter implements IProfileAddressEntityFilter
{

    public function filter(IProfileAddressEntity $entity): void
    {
        if($entity->getCountry()) $entity->setCountry(strtoupper($entity->getCountry()));

    }
}
