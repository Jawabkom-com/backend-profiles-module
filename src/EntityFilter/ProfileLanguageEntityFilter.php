<?php

namespace Jawabkom\Backend\Module\Profile;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileLanguageEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;

class ProfileLanguageEntityFilter implements IProfileLanguageEntityFilter
{

    public function filter(IProfileLanguageEntity $entity): void
    {
        if($entity->getCountry()) $entity->setCountry(strtoupper($entity->getCountry()));
        if($entity->getLanguage()) $entity->setLanguage(strtolower($entity->getLanguage()));
    }
}