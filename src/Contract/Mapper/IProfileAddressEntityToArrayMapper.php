<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;

interface IProfileAddressEntityToArrayMapper
{
    public function map(IProfileAddressEntity $profile):array;
}
