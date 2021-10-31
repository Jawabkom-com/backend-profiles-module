<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;

interface IProfileCriminalRecordHashGenerator
{
    public function generate(IProfileCriminalRecordEntity $entity, IArrayHashing $arrayHashing):string;
}
