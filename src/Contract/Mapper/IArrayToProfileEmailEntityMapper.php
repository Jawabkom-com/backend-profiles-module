<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;

interface IArrayToProfileEmailEntityMapper
{
    public function map(array $profile, ?IProfileEmailEntity &$entity = null):IProfileEmailEntity;
}
