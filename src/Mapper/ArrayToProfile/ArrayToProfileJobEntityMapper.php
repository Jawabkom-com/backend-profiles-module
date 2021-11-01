<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileJobEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileJobEntityMapper extends AbstractMapper implements IArrayToProfileJobEntityMapper
{

    public function map(array $profile, ?IProfileJobEntity &$entity = null):IProfileJobEntity
    {
        if(!$entity)
            $entity = $this->di->make(IProfileJobEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setFrom(!empty($profile['from']) ? new \DateTime($profile['from']) : null);
        $entity->setTo(!empty($profile['to']) ? new \DateTime($profile['to']) : null);
        $entity->setTitle($profile['title'] ?? null);
        $entity->setOrganization($profile['organization'] ?? null);
        $entity->setIndustry($profile['industry'] ?? null);
        return $entity;
    }
}
