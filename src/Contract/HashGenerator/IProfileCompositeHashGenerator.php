<?php

namespace Jawabkom\Backend\Module\Profile\Contract\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface IProfileCompositeHashGenerator
{
    public function generate(IProfileComposite $composite, IArrayHashing $arrayHashing):string;
}
