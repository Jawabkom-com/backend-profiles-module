<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;

interface IProfileJobEntityToArrayMapper
{
    public function map(IProfileJobEntity $jobEntity):array;
}
