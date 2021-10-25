<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileImageEntityMapper;

class ArrayToProfileImageEntityMapper extends AbstractMapper implements IArrayToProfileImageEntityMapper
{

    public function map(array $profile, ?IProfileImageEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileImageEntity::class);
        $entity->setOriginalUrl($profile['original_url'] ?? null);
        $entity->setLocalPath($profile['local_path'] ?? null);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
    }
}
