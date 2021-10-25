<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;

interface IProfileMetaDataEntityToArrayMapper
{
    public function map(IProfileMetaDataEntity $metaDataEntity):array;
}
