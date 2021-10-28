<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;

interface IProfileImageEntityFilter
{
    public function filter(IProfileImageEntity $entity):void;
}
