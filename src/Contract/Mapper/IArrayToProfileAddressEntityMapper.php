<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;

interface IArrayToProfileAddressEntityMapper
{
    public function map(array $profile, ?IProfileAddressEntity &$entity = null);
}
