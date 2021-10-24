<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

trait ProfileAddEditMethods
{
    protected function fillProfileEntity(IProfileEntity $profileEntity, array $inputs)
    {
        $profileEntity->setGender($inputs['gender'] ?? null);
        $profileEntity->setDataSource($inputs['data_source'] ?? null);
        $profileEntity->setPlaceOfBirth($inputs['place_of_birth'] ?? null);
        $profileEntity->setDateOfBirth(!empty($inputs['date_of_birth']) ? new \DateTime($inputs['date_of_birth']) : null);

    }

    protected function fillNameEntity(IProfileEntity $profileEntity, IProfileNameEntity $profileNameEntity, array $name)
    {
        $profileNameEntity->setProfileId($profileEntity->getProfileId());
        $profileNameEntity->setFirst($name['first'] ?? null);
        $profileNameEntity->setMiddle($name['middle'] ?? null);
        $profileNameEntity->setLast($name['last'] ?? null);
        $profileNameEntity->setPrefix($name['prefix'] ?? null);
        $displayName = preg_replace('#[\s]+#', ' ', trim($profileNameEntity->getPrefix() . ' ' . $profileNameEntity->getFirst() . ' ' . $profileNameEntity->getMiddle() . ' ' . $profileNameEntity->getLast()));
        $profileNameEntity->setDisplay($displayName);
    }

    protected function fillAddressEntity(IProfileEntity $profileEntity, IProfileAddressEntity $profileAddressEntity, array $address)
    {
        $profileAddressEntity->setProfileId($profileEntity->getProfileId());
        $profileAddressEntity->setValidSince(!empty($address['valid_since']) ? new \DateTime($address['valid_since']) : null);
        $profileAddressEntity->setCountry($address['country'] ?? null);
        $profileAddressEntity->setState($address['state'] ?? null);
        $profileAddressEntity->setCity($address['city'] ?? null);
        $profileAddressEntity->setZip($address['zip'] ?? null);
        $profileAddressEntity->setStreet($address['street'] ?? null);
        $profileAddressEntity->setBuildingNumber($address['building_number'] ?? null);
        $profileAddressEntity->setDisplay($address['display'] ?? null);
    }

    protected function fillCriminalRecordEntity(IProfileEntity $profileEntity, IProfileCriminalRecordEntity $profileCriminalRecordEntity, array $criminalRecord)
    {
        $profileCriminalRecordEntity->setProfileId($profileEntity->getProfileId());
        $profileCriminalRecordEntity->setCaseNumber($criminalRecord['case_number'] ?? null);
        $profileCriminalRecordEntity->setCaseType($criminalRecord['case_type'] ?? null);
        $profileCriminalRecordEntity->setCaseYear($criminalRecord['case_year'] ?? null);
        $profileCriminalRecordEntity->setCaseStatus($criminalRecord['case_status'] ?? null);
        $profileCriminalRecordEntity->setDisplay($criminalRecord['display'] ?? null);
    }

    protected function fillEducationEntity(IProfileEntity $profileEntity, IProfileEducationEntity $profileEducationEntity, array $education)
    {
        $profileEducationEntity->setProfileId($profileEntity->getProfileId());
        $profileEducationEntity->setValidSince(!empty($education['valid_since']) ? new \DateTime($education['valid_since']) : null);
        $profileEducationEntity->setFrom($education['from'] ?? null);
        $profileEducationEntity->setTo($education['to'] ?? null);
        $profileEducationEntity->setSchool($education['school'] ?? null);
        $profileEducationEntity->setDegree($education['degree'] ?? null);;
        $profileEducationEntity->setMajor($education['major'] ?? null);;
    }

    protected function fillEmailEntity(IProfileEntity $profileEntity, IProfileEmailEntity $profileEmailEntity, array $email)
    {
        $profileEmailEntity->setProfileId($profileEntity->getProfileId());
        $profileEmailEntity->setValidSince(!empty($email['valid_since']) ? new \DateTime($email['valid_since']) : null);
        $profileEmailEntity->setEmail($email['email'] ?? null);
        $profileEmailEntity->setEspDomain($email['esp_domain'] ?? null);
        $profileEmailEntity->setType($email['type'] ?? null);
    }

    protected function fillImageEntity(IProfileEntity $profileEntity, IProfileImageEntity $profileImageEntity, array $image)
    {
        $profileImageEntity->setProfileId($profileEntity->getProfileId());
        $profileImageEntity->setOriginalUrl($image['original_url'] ?? null);
        $profileImageEntity->setLocalPath($image['local_path'] ?? null);
        $profileImageEntity->setValidSince(!empty($image['valid_since']) ? new \DateTime($image['valid_since']) : null);
    }

    protected function fillJobEntity(IProfileEntity $profileEntity, IProfileJobEntity $profileJobEntity, array $job)
    {
        $profileJobEntity->setProfileId($profileEntity->getProfileId());
        $profileJobEntity->setValidSince(!empty($job['valid_since']) ? new \DateTime($job['valid_since']) : null);
        $profileJobEntity->setFrom($job['from'] ?? null);
        $profileJobEntity->setTo($job['to'] ?? null);
        $profileJobEntity->setTitle($job['title'] ?? null);
        $profileJobEntity->setOrganization($job['organization'] ?? null);
        $profileJobEntity->setIndustry($job['industry'] ?? null);
    }

    protected function fillLanguageEntity(IProfileEntity $profileEntity, IProfileLanguageEntity $profileLanguageEntity, array $language)
    {
        $profileLanguageEntity->setProfileId($profileEntity->getProfileId());
        $profileLanguageEntity->setLanguage($language['language'] ?? null);
        $profileLanguageEntity->setCountry($job['country'] ?? null);
    }

    protected function fillPhoneEntity(IProfileEntity $profileEntity, IProfilePhoneEntity $profilePhoneEntity, array $phone)
    {
        $profilePhoneEntity->setValidSince(!empty($phone['valid_since']) ? new \DateTime($phone['valid_since']) : null);
        $profilePhoneEntity->setProfileId($profileEntity->getProfileId());
        $profilePhoneEntity->setType($phone['type'] ?? null);
        $profilePhoneEntity->setDoNotCallFlag($phone['do_not_call_flag'] ?? null);
        $profilePhoneEntity->setCountryCode($phone['country_code'] ?? null);
        $profilePhoneEntity->setOriginalNumber($phone['original_number'] ?? null);
        $profilePhoneEntity->setFormattedNumber($phone['formatted_number'] ?? null);
        $profilePhoneEntity->setValidPhone($phone['valid_phone'] ?? null);
        $profilePhoneEntity->setRiskyPhone($phone['risky_phone'] ?? null);
        $profilePhoneEntity->setDisposablePhone($phone['disposable_phone'] ?? null);
        $profilePhoneEntity->setCarrier($phone['carrier'] ?? null);
        $profilePhoneEntity->setPurpose($phone['purpose'] ?? null);
        $profilePhoneEntity->setIndustry($phone['industry'] ?? null);
    }

    protected function fillRelationshipEntity(IProfileEntity $profileEntity, IProfileRelationshipEntity $profileRelationshipEntity, array $relationship)
    {
        $profileRelationshipEntity->setProfileId($profileEntity->getProfileId());
        $profileRelationshipEntity->setValidSince(!empty($relationship['valid_since']) ? new \DateTime($relationship['valid_since']) : null);
        $profileRelationshipEntity->setType($relationship['type'] ?? null);
        $profileRelationshipEntity->setFirstName($relationship['first_name'] ?? null);
        $profileRelationshipEntity->setLastName($relationship['last_name'] ?? null);
        $profileRelationshipEntity->setPersonId($relationship['person_id'] ?? null);
    }

    protected function fillSkillEntity(IProfileEntity $profileEntity, IProfileSkillEntity $profileSkillEntity, array $skill)
    {
        $profileSkillEntity->setProfileId($profileEntity->getProfileId());
        $profileSkillEntity->setValidSince(!empty($skill['valid_since']) ? new \DateTime($skill['valid_since']) : null);
        $profileSkillEntity->setLevel($skill['level'] ?? null);
        $profileSkillEntity->setSkill($skill['skill'] ?? null);
    }

    protected function fillSocialProfileEntity(IProfileEntity $profileEntity, IProfileSocialProfileEntity $profileSocialProfileEntity, array $socialProfile)
    {
        $profileSocialProfileEntity->setProfileId($profileEntity->getProfileId());
        $profileSocialProfileEntity->setValidSince(!empty($socialProfile['valid_since']) ? new \DateTime($socialProfile['valid_since']) : null);
        $profileSocialProfileEntity->setUrl($socialProfile['url'] ?? null);
        $profileSocialProfileEntity->setType($socialProfile['type'] ?? null);
        $profileSocialProfileEntity->setUsername($socialProfile['username'] ?? null);
        $profileSocialProfileEntity->setAccountId($socialProfile['account_id'] ?? null);
    }

    protected function fillUsernameEntity(IProfileEntity $profileEntity, IProfileUsernameEntity $profileUsernameEntity, array $username)
    {
        $profileUsernameEntity->setProfileId($profileEntity->getProfileId());
        $profileUsernameEntity->setValidSince(!empty($username['valid_since']) ? new \DateTime($username['valid_since']) : null);
        $profileUsernameEntity->setUsername($username['username'] ?? null);
    }

    protected function fillMetaDataEntity(IProfileEntity $profileEntity, IProfileMetaDataEntity $profileMetaDataEntity, array $meta)
    {
        $profileMetaDataEntity->setProfileId($profileEntity->getProfileId());
        $profileMetaDataEntity->setMetaKey($meta['key'] ?? null);
        $profileMetaDataEntity->setMetaValue($meta['value'] ?? null);
    }
}
