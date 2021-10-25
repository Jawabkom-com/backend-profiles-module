<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;

interface IProfileEmailEntityToArrayMapper
{
    public function map(IProfileEmailEntity $emailEntity):array;

}
