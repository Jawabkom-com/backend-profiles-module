<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;

interface IProfileEntityFilter
{
    public function filter(IProfileEntity $entity):void;
}
