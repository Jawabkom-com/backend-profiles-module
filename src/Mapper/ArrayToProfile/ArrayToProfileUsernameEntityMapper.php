<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileUsernameEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileUsernameEntityMapper extends AbstractMapper implements IArrayToProfileUsernameEntityMapper
{

    public function map(array $profile, ?IProfileUsernameEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileUsernameEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setUsername($profile['username'] ?? null);
    }
}
