<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileSocialProfileEntityMapper;

class ArrayToProfileSocialProfileEntityMapper extends AbstractMapper implements IArrayToProfileSocialProfileEntityMapper
{

    public function map(array $profile, ?IProfileSocialProfileEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileSocialProfileEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setUrl($profile['url'] ?? null);
        $entity->setType($profile['type'] ?? null);
        $entity->setUsername($profile['username'] ?? null);
        $entity->setAccountId($profile['account_id'] ?? null);
    }
}
