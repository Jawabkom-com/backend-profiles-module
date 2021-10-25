<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;

interface IArrayToProfileLanguageEntityMapper
{
    public function map(array $profile, ?IProfileLanguageEntity &$entity = null);
}
