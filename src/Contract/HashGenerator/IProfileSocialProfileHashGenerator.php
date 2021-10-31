<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;

interface IProfileSocialProfileHashGenerator
{
    public function generate(IProfileSocialProfileEntity $entity, IArrayHashing $arrayHashing):string;
}
