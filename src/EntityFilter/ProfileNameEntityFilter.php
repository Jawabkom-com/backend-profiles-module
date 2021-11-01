<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileNameEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\INameScoring;

class ProfileNameEntityFilter implements IProfileNameEntityFilter
{

    public function filter(IProfileNameEntity $entity, INameScoring $nameScoring): void
    {
        $display = preg_replace('#[\s]+#', ' ', trim($entity->getPrefix() . ' ' . $entity->getFirst() . ' ' . $entity->getMiddle() . ' ' . $entity->getLast()));
        $entity->setScore($nameScoring->score($display));
        $entity->setDisplay($display);
    }
}
