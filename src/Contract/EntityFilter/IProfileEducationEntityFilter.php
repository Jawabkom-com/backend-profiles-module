<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;

interface IProfileEducationEntityFilter
{
    public function filter(IProfileEducationEntity $entity):void;
}
