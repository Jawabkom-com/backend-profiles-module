<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;

interface IArrayToProfilePhoneEntityMapper
{
    public function map(array $profile, ?IProfilePhoneEntity &$entity = null):IProfilePhoneEntity;
}
