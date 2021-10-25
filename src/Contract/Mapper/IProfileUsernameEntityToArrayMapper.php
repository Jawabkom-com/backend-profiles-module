<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

interface IProfileUsernameEntityToArrayMapper
{
    public function map(IProfileUsernameEntity $usernameEntity):array;
}
