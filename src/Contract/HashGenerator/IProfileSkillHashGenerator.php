<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;

interface IProfileSkillHashGenerator
{
    public function generate(IProfileSkillEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
