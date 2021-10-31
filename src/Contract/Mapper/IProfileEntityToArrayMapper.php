<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;

interface IProfileEntityToArrayMapper
{
    public function map(IProfileEntity $profileEntity, $withProfileId = false):array;
}
