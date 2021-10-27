<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;

interface IProfileMetaDataHashGenerator
{
    public function generate(IProfileMetaDataEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
