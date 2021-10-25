<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;

interface IProfileEducationEntityToArrayMapper
{
    public function map(IProfileEducationEntity $educationEntity):array;
}
