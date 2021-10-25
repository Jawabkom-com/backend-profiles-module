<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileAddressEntityMapper;

class ArrayToProfileAddressEntityMapper extends AbstractMapper implements IArrayToProfileAddressEntityMapper
{

    public function map(array $profile, ?IProfileAddressEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileAddressEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setCountry($profile['country'] ?? null);
        $entity->setState($profile['state'] ?? null);
        $entity->setCity($profile['city'] ?? null);
        $entity->setZip($profile['zip'] ?? null);
        $entity->setStreet($profile['street'] ?? null);
        $entity->setBuildingNumber($profile['building_number'] ?? null);
        $entity->setDisplay($profile['display'] ?? null);
    }
}
