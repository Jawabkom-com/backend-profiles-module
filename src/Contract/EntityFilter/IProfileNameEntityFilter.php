<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\INameScoring;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ISearchableText;

interface IProfileNameEntityFilter
{
    public function filter(IProfileNameEntity $entity, INameScoring $nameScoring, ISearchableText $searchableText):void;
}
