<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;

interface IProfileHashGenerator
{
    public function generate(IProfileEntity $entity, IArrayHashing $arrayHashing):string;
}
