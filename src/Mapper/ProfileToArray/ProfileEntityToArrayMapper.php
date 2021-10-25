<?php

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;

class ProfileEntityToArrayMapper implements IProfileEntityToArrayMapper
{

    public function map(IProfileEntity $profileEntity): array
    {
        return [
            'profile_id' => $profileEntity->getProfileId(),
            'gender' => $profileEntity->getGender(),
            'date_of_birth' => $profileEntity->getDateOfBirth(),
            'place_of_birth' => $profileEntity->getPlaceOfBirth(),
            'data_source' => $profileEntity->getDataSource(),
        ];
    }
}