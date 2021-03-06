<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileNameEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileNameEntityMapper extends AbstractMapper implements IArrayToProfileNameEntityMapper
{

    public function map(array $profile, ?IProfileNameEntity &$entity = null):IProfileNameEntity
    {
        if(!$entity)
            $entity = $this->di->make(IProfileNameEntity::class);
        $entity->setFirst($profile['first'] ?? null);
        $entity->setMiddle($profile['middle'] ?? null);
        $entity->setLast($profile['last'] ?? null);
        $entity->setPrefix($profile['prefix'] ?? null);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        return $entity;
    }
}
