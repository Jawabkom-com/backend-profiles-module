<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;

interface IArrayToProfileEducationEntityMapper
{
    public function map(array $profile, ?IProfileEducationEntity &$entity = null);
}
