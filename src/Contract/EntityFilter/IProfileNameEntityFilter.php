<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;

interface IProfileNameEntityFilter
{
    public function filter(IProfileNameEntity $entity):void;
}
