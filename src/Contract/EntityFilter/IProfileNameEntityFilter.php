<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\INameScoring;

interface IProfileNameEntityFilter
{
    public function filter(IProfileNameEntity $entity, INameScoring $nameScoring):void;
}
