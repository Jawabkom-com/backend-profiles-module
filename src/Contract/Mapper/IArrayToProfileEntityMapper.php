<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;

interface IArrayToProfileEntityMapper
{
    public function map(array $profile, ?IProfileEntity &$entity = null);
}
