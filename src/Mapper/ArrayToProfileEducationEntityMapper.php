<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEducationEntityMapper;

class ArrayToProfileEducationEntityMapper extends AbstractMapper implements IArrayToProfileEducationEntityMapper
{

    public function map(array $profile, ?IProfileEducationEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileEducationEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setFrom($profile['from'] ?? null);
        $entity->setTo($profile['to'] ?? null);
        $entity->setSchool($profile['school'] ?? null);
        $entity->setDegree($profile['degree'] ?? null);;
        $entity->setMajor($profile['major'] ?? null);;
    }
}
