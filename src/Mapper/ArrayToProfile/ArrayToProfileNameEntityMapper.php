<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileNameEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileNameEntityMapper extends AbstractMapper implements IArrayToProfileNameEntityMapper
{

    public function map(array $profile, ?IProfileNameEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileNameEntity::class);
        $entity->setFirst($profile['first'] ?? null);
        $entity->setMiddle($profile['middle'] ?? null);
        $entity->setLast($profile['last'] ?? null);
        $entity->setPrefix($profile['prefix'] ?? null);
        $displayName = preg_replace('#[\s]+#', ' ', trim($entity->getPrefix() . ' ' . $entity->getFirst() . ' ' . $entity->getMiddle() . ' ' . $entity->getLast()));
        $entity->setDisplay($displayName);
    }
}
