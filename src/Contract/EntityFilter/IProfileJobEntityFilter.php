<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;

interface IProfileJobEntityFilter
{
    public function filter(IProfileJobEntity $entity):void;
}
