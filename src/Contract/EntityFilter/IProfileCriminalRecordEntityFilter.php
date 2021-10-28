<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;

interface IProfileCriminalRecordEntityFilter
{
    public function filter(IProfileCriminalRecordEntity $entity):void;
}
