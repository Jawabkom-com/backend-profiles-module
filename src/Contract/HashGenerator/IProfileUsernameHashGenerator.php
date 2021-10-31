<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

interface IProfileUsernameHashGenerator
{
    public function generate(IProfileUsernameEntity $entity, IArrayHashing $arrayHashing):string;
}
