<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;

interface IProfileSkillEntityToArrayMapper
{
    public function map(IProfileSkillEntity $skillEntity):array;
}
