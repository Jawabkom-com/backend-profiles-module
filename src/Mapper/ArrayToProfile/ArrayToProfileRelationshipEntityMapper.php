<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileRelationshipEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileRelationshipEntityMapper extends AbstractMapper implements IArrayToProfileRelationshipEntityMapper
{

    public function map(array $profile, ?IProfileRelationshipEntity &$entity = null):IProfileRelationshipEntity
    {
        if(!$entity)
            $entity = $this->di->make(IProfileRelationshipEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setType($profile['type'] ?? null);
        $entity->setFirstName($profile['first_name'] ?? null);
        $entity->setLastName($profile['last_name'] ?? null);
        $entity->setPersonId($profile['person_id'] ?? null);
        return $entity;
    }
}
