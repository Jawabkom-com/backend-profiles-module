<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;

interface IProfileLanguageEntityToArrayMapper
{
    public function map(IProfileLanguageEntity $languageEntity):array;
}
