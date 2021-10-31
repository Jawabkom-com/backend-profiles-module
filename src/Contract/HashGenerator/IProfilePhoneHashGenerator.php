<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;

interface IProfilePhoneHashGenerator
{
    public function generate(IProfilePhoneEntity $entity, IArrayHashing $arrayHashing):string;
}
