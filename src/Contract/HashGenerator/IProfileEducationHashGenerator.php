<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;

interface IProfileEducationHashGenerator
{
    public function generate(IProfileEducationEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
