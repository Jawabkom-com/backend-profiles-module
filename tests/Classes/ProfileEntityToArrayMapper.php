<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;

class ProfileEntityToArrayMapper implements IProfileEntityToArrayMapper
{

    public function map(IProfileEntity $profileEntity): array
    {
        $profileEntity->names           = $profileEntity->profileName()->get()->toArray();
        $profileEntity->phones          = $profileEntity->profilePhone()->get()->toArray();
        $profileEntity->addresses       = $profileEntity->profileAddress()->get()->toArray();
        $profileEntity->usernames       = $profileEntity->profileUsername()->get()->toArray();
        $profileEntity->emails          = $profileEntity->profileEmail()->get()->toArray();
        $profileEntity->relationships   = $profileEntity->profileRelationship()->get()->toArray();
        $profileEntity->skills          = $profileEntity->profileSkill()->get()->toArray();
        $profileEntity->images          = $profileEntity->profileImage()->get()->toArray();
        $profileEntity->languages       = $profileEntity->profileLanguage()->get()->toArray();
        $profileEntity->jobs            = $profileEntity->profileJob()->get()->toArray();
        $profileEntity->educations      = $profileEntity->profileEducation()->get()->toArray();
        $profileEntity->socialProfiles  = $profileEntity->profileSocialProfile()->get()->toArray();
        $profileEntity->criminalRecords = $profileEntity->profileCriminalRecord()->get()->toArray();
        $profileEntity->metaData        = $profileEntity->metaData()->get()->toArray();
        return $profileEntity->toArray();

    }
}