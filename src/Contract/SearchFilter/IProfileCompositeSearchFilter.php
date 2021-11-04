<?php

namespace Jawabkom\Backend\Module\Profile\Contract\SearchFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface IProfileCompositeSearchFilter
{
    public function apply(IProfileComposite $composite):bool;
}
