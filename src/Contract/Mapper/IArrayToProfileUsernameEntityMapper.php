<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

interface IArrayToProfileUsernameEntityMapper
{
    public function map(array $profile, ?IProfileUsernameEntity &$entity = null):IProfileUsernameEntity;
}
