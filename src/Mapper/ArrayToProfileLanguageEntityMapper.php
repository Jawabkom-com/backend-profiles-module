<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileLanguageEntityMapper;

class ArrayToProfileLanguageEntityMapper extends AbstractMapper implements IArrayToProfileLanguageEntityMapper
{

    public function map(array $profile, ?IProfileLanguageEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileLanguageEntity::class);
        $entity->setLanguage($profile['language'] ?? null);
        $entity->setCountry($profile['country'] ?? null);
    }
}
