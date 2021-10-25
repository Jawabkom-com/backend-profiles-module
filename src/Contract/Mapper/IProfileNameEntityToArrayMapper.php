<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;

interface IProfileNameEntityToArrayMapper
{
    public function map(IProfileNameEntity $nameEntity):array;
}
