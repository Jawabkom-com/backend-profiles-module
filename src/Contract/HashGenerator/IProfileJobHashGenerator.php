<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;

interface IProfileJobHashGenerator
{
    public function generate(IProfileJobEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
