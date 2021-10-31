<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileNameEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;

class ProfileNameEntityFilter implements IProfileNameEntityFilter
{

    public function filter(IProfileNameEntity $entity): void
    {
        $entity->setDisplay(preg_replace('#[\s]+#', ' ', trim($entity->getPrefix() . ' ' . $entity->getFirst() . ' ' . $entity->getMiddle() . ' ' . $entity->getLast())));
    }
}
