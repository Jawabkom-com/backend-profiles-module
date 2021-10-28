<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;

interface IProfileSkillEntityFilter
{
    public function filter(IProfileSkillEntity $entity):void;
}
