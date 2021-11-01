<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEmailEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileEmailEntityMapper extends AbstractMapper implements IArrayToProfileEmailEntityMapper
{

    public function map(array $profile, ?IProfileEmailEntity &$entity = null):IProfileEmailEntity
    {
        if(!$entity)
            $entity = $this->di->make(IProfileEmailEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setEmail($profile['email'] ?? null);
        $entity->setEspDomain($profile['esp_domain'] ?? null);
        $entity->setType($profile['type'] ?? null);
        return $entity;
    }
}
