<?php

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;

class ProfileEmailHashGenerator implements IProfileEmailHashGenerator
{

    public function generate(IProfileEmailEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        // TODO: Implement generate() method.
    }
}
