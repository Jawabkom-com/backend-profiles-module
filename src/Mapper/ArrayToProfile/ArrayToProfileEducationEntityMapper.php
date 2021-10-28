<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEducationEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfileEducationEntityMapper extends AbstractMapper implements IArrayToProfileEducationEntityMapper
{

    public function map(array $profile, ?IProfileEducationEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileEducationEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setFrom(!empty($profile['from']) ? new \DateTime($profile['from']) : null);
        $entity->setTo(!empty($profile['to']) ? new \DateTime($profile['to']) : null);
        $entity->setSchool($profile['school'] ?? null);
        $entity->setDegree($profile['degree'] ?? null);;
        $entity->setMajor($profile['major'] ?? null);;
    }
}
