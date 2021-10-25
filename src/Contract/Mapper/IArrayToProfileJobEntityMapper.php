<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;

interface IArrayToProfileJobEntityMapper
{
    public function map(array $profile, ?IProfileJobEntity &$entity = null);
}
