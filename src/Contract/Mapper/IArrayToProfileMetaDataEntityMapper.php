<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;

interface IArrayToProfileMetaDataEntityMapper
{
    public function map(array $profile, ?IProfileMetaDataEntity &$entity = null);
}
