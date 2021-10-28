<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;

interface IProfileLanguageEntityFilter
{
    public function filter(IProfileLanguageEntity $entity):void;
}
