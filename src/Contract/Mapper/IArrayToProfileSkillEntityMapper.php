<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;

interface IArrayToProfileSkillEntityMapper
{
    public function map(array $profile, ?IProfileSkillEntity &$entity = null):IProfileSkillEntity;
}
