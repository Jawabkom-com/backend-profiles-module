<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface IProfileCompositeEntitiesFilter
{
    public function filter(IProfileComposite $composite):void;
}
