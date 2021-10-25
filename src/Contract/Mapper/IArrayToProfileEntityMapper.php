<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

interface IArrayToProfileEntityMapper
{
    public function map(array $profile, ?IProfileEntity &$entity = null);
}
