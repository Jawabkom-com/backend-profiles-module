<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;

interface IProfileMetaDataEntityFilter
{
    public function filter(IProfileMetaDataEntity $entity):void;
}
