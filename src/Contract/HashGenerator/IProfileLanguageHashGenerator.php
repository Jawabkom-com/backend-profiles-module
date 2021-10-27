<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;

interface IProfileLanguageHashGenerator
{
    public function generate(IProfileLanguageEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
