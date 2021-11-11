<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Libraries;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface ICompositesMerge
{
    public function merge(IProfileComposite ...$composites):IProfileComposite;
}

// composite1      composite2       composite3
// name1, name2    name1, name3     name1, name2, name3
// address1                         address1