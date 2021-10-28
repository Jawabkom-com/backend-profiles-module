<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;

interface IProfilePhoneEntityFilter
{
    public function filter(IProfilePhoneEntity $entity):void;
}
