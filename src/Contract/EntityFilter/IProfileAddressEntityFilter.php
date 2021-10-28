<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;

interface IProfileAddressEntityFilter
{
    public function filter(IProfileAddressEntity $entity):void;
}
