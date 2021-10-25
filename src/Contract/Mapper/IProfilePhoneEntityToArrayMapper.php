<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;

interface IProfilePhoneEntityToArrayMapper
{
    public function map(IProfilePhoneEntity $phoneEntity):array;
}
