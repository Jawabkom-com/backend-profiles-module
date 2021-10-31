<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;

interface IProfileNameHashGenerator
{
    public function generate(IProfileNameEntity $entity, IArrayHashing $arrayHashing):string;
}
