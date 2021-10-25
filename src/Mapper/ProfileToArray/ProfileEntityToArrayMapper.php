<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;

class ProfileEntityToArrayMapper implements IProfileEntityToArrayMapper
{

    public function map(IProfileEntity $profileEntity,$withProfileId): array
    {
        $toReturn = [
            'gender' => $profileEntity->getGender(),
            'date_of_birth' => $profileEntity->getDateOfBirth(),
            'place_of_birth' => $profileEntity->getPlaceOfBirth(),
            'data_source' => $profileEntity->getDataSource(),
        ];
        if ($withProfileId)
            $toReturn['profile_id'] = $profileEntity->getProfileId();
        return $toReturn;
    }
}