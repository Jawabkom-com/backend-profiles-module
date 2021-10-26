<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;

class ProfileEntityToArrayMapper implements IProfileEntityToArrayMapper
{

    public function map(IProfileEntity $profileEntity,$withProfileId): array
    {
        $toReturn =[];
        if ($withProfileId)
            $toReturn['profile_id'] = $profileEntity->getProfileId();

            $toReturn['gender'] = $profileEntity->getGender();
            $toReturn['date_of_birth'] = $profileEntity->getDateOfBirth()?->format('Y-m-d');
            $toReturn['place_of_birth'] = $profileEntity->getPlaceOfBirth();
            $toReturn['data_source'] = $profileEntity->getDataSource();
        return $toReturn;
    }
}