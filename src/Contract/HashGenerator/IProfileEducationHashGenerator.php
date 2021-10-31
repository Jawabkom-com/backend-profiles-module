<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;

interface IProfileEducationHashGenerator
{
    public function generate(IProfileEducationEntity $entity, IArrayHashing $arrayHashing):string;
}
