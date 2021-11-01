<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileEntityMapper extends AbstractMapper implements IArrayToProfileEntityMapper
{

    public function map(array $profile, ?IProfileEntity &$entity = null):IProfileEntity
    {
        if(!$entity)
            $entity = $this->di->make(IProfileEntity::class);
        $entity->setGender($profile['gender'] ?? null);
        $entity->setDataSource($profile['data_source'] ?? null);
        $entity->setPlaceOfBirth($profile['place_of_birth'] ?? null);
        $entity->setDateOfBirth(!empty($profile['date_of_birth']) ? new \DateTime($profile['date_of_birth']) : null);
        return $entity;
    }
}
