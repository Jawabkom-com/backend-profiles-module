<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;

interface IArrayToProfileNameEntityMapper
{
    public function map(array $profile, ?IProfileNameEntity &$entity = null):IProfileNameEntity;
}
