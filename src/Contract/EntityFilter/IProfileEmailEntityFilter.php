<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;

interface IProfileEmailEntityFilter
{
    public function filter(IProfileEmailEntity $entity):void;
}
