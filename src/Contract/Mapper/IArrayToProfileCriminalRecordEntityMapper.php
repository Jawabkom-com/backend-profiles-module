<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;

interface IArrayToProfileCriminalRecordEntityMapper
{
    public function map(array $profile, ?IProfileCriminalRecordEntity &$entity = null);
}
