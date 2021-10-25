<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileJobEntityMapper;

class ArrayToProfileJobEntityMapper extends AbstractMapper implements IArrayToProfileJobEntityMapper
{

    public function map(array $profile, ?IProfileJobEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileJobEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setFrom($profile['from'] ?? null);
        $entity->setTo($profile['to'] ?? null);
        $entity->setTitle($profile['title'] ?? null);
        $entity->setOrganization($profile['organization'] ?? null);
        $entity->setIndustry($profile['industry'] ?? null);
    }
}
