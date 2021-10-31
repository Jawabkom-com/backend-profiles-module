<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;

interface IProfileEmailHashGenerator
{
    public function generate(IProfileEmailEntity $entity, IArrayHashing $arrayHashing):string;
}
