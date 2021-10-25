<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileSkillEntityMapper;

class ArrayToProfileSkillEntityMapper extends AbstractMapper implements IArrayToProfileSkillEntityMapper
{

    public function map(array $profile, ?IProfileSkillEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileSkillEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setLevel($profile['level'] ?? null);
        $entity->setSkill($profile['skill'] ?? null);
    }
}
