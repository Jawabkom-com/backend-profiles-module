<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;

interface IArrayToProfileImageEntityMapper
{
    public function map(array $profile, ?IProfileImageEntity &$entity = null);
}
