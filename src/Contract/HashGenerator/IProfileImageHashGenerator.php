<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;

interface IProfileImageHashGenerator
{
    public function generate(IProfileImageEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
