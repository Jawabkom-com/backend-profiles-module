<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;

interface IProfileImageEntityToArrayMapper
{
    public function map(IProfileImageEntity $imageEntity):array;
}
