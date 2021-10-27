<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;

interface IProfileRelationsHashGenerator
{
    public function generate(IProfileRelationshipEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
