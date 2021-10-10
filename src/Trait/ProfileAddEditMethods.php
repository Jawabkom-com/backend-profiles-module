<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Ramsey\Uuid\Uuid;

trait ProfileAddEditMethods
{
    protected function fillProfileEntity(IProfileEntity $profileEntity, array $inputs, bool $generateId = true)
    {
        if($generateId) {
            $profileEntity->setProfileId(Uuid::uuid4());
        }
        $profileEntity->setGender($inputs['gender'] ?? '');
        $profileEntity->setDataSource($inputs['data_source'] ?? '');
        $profileEntity->setPlaceOfBirth($inputs['place_of_birth'] ?? '');
        if(isset($inputs['date_of_birth']))
            $profileEntity->setDateOfBirth(new \DateTime($inputs['date_of_birth']));

    }

    protected function fillNameEntity(IProfileEntity $profileEntity, IProfileNameEntity $profileNameEntity, array $name)
    {
        $profileNameEntity->setFirst($name['first'] ?? '');
        $profileNameEntity->setMiddle($name['middle'] ?? '');
        $profileNameEntity->setLast($name['last'] ?? '');
        $profileNameEntity->setPrefix($name['prefix'] ?? '');
        $displayName = preg_replace('#[\s]+#', ' ', trim($profileNameEntity->getPrefix() . ' ' . $profileNameEntity->getFirst() . ' ' . $profileNameEntity->getMiddle() . ' ' . $profileNameEntity->getLast()));
        $profileNameEntity->setDisplay($displayName);
    }

}
