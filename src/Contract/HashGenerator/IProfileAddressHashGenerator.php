<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;

interface IProfileAddressHashGenerator
{
    public function generate(IProfileAddressEntity $entity, string $profileId, IArrayHashing $arrayHashing):string;
}
