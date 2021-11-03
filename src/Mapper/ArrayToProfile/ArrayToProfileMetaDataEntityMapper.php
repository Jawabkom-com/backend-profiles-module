<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileMetaDataEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileMetaDataEntityMapper extends AbstractMapper implements IArrayToProfileMetaDataEntityMapper
{

    public function map(array $profile, ?IProfileMetaDataEntity &$entity = null):IProfileMetaDataEntity
    {
        if(!$entity)
            $entity = $this->di->make(IProfileMetaDataEntity::class);
        $entity->setMetaKey($profile['meta_key'] ?? null);
        $entity->setMetaValue($profile['meta_key'] ?? null);
        return $entity;
    }
}
