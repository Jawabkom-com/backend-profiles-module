<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;

class ProfilesDataBase
{
    protected array $profiles = [];

    public function addProfile(IProfileEntity $entity)
    {
        $this->profiles[$entity->getProfileId()] = $entity;
    }

    public function deleteProfileByID($id) {
        unset($this->profiles[$id]);
    }

    /**
     * @return IProfileEntity[]
     */
    public function getAll() {
        return $this->profiles;
    }


}
