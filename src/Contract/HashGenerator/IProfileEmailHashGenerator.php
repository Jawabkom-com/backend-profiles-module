<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEmailHashGenerator
{
    public function generate(IProfileEmailEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
