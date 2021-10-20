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
        $profileNameEntity->setProfileId($profileEntity->getProfileId());
        $profileNameEntity->setFirst($name['first'] ?? '');
        $profileNameEntity->setMiddle($name['middle'] ?? '');
        $profileNameEntity->setLast($name['last'] ?? '');
        $profileNameEntity->setPrefix($name['prefix'] ?? '');
        $displayName = preg_replace('#[\s]+#', ' ', trim($profileNameEntity->getPrefix() . ' ' . $profileNameEntity->getFirst() . ' ' . $profileNameEntity->getMiddle() . ' ' . $profileNameEntity->getLast()));
        $profileNameEntity->setDisplay($displayName);
    }

    protected function fillAddressEntity(IProfileEntity $profileEntity, IProfileAddressEntity $profileAddressEntity, array $address)
    {
        $profileAddressEntity->setProfileId($profileEntity->getProfileId());
        $profileAddressEntity->setValidSince($address['valid_since'] ?? '');
        $profileAddressEntity->setCountry($address['country'] ?? '');
        $profileAddressEntity->setState($address['state'] ?? '');
        $profileAddressEntity->setCity($address['city'] ?? '');
        $profileAddressEntity->setZip($address['zip'] ?? '');
        $profileAddressEntity->setStreet($address['street'] ?? '');
        $profileAddressEntity->setBuildingNumber($address['building_number'] ?? '');
        $profileAddressEntity->setDisplay($address['display'] ?? '');
    }

    protected function fillCriminalRecordEntity(IProfileEntity $profileEntity, IProfileCriminalRecordEntity $profileCriminalRecordEntity, array $criminalRecord)
    {
        $profileCriminalRecordEntity->setProfileId($profileEntity->getProfileId());
        $profileCriminalRecordEntity->setCaseNumber($criminalRecord['case_number'] ?? '');
        $profileCriminalRecordEntity->setCaseType($criminalRecord['case_type'] ?? '');
        $profileCriminalRecordEntity->setCaseYear($criminalRecord['case_year'] ?? '');
        $profileCriminalRecordEntity->setCaseStatus($criminalRecord['case_status'] ?? '');
        $profileCriminalRecordEntity->setDisplay($criminalRecord['display'] ?? '');
    }

    protected function fillEducationEntity(IProfileEntity $profileEntity, IProfileEducationEntity $profileEducationEntity, array $education)
    {
        $profileEducationEntity->setProfileId($profileEntity->getProfileId());
        $profileEducationEntity->setValidSince($education['valid_since'] ?? '');
        $profileEducationEntity->setFrom($education['from'] ?? '');
        $profileEducationEntity->setTo($education['to'] ?? '');
        $profileEducationEntity->setSchool($education['school'] ?? '');
        $profileEducationEntity->setDegree($education['degree'] ?? '');;
        $profileEducationEntity->setMajor($education['major'] ?? '');;
    }

    protected function fillEmailEntity(IProfileEntity $profileEntity, IProfileEmailEntity $profileEmailEntity, array $email)
    {
        $profileEmailEntity->setProfileId($profileEntity->getProfileId());
        $profileEmailEntity->setValidSince($email['valid_since'] ?? '');
        $profileEmailEntity->setEmail($email['email'] ?? '');
        $profileEmailEntity->setEspDomain($email['esp_domain'] ?? '');
        $profileEmailEntity->setType($email['type'] ?? '');
    }

    protected function fillImageEntity(IProfileEntity $profileEntity, IProfileImageEntity $profileImageEntity, array $image)
    {
        $profileImageEntity->setProfileId($profileEntity->getProfileId());
        $profileImageEntity->setOriginalUrl($image['original_url'] ?? '');
        $profileImageEntity->setLocalPath($image['local_path'] ?? '');
        $profileImageEntity->setValidSince($image['valid_since'] ?? '');
    }

    protected function fillJobEntity(IProfileEntity $profileEntity, IProfileJobEntity $profileJobEntity, array $job)
    {
        $profileJobEntity->setProfileId($profileEntity->getProfileId());
        $profileJobEntity->setValidSince($job['valid_since'] ?? '');
        $profileJobEntity->setFrom($job['from'] ?? '');
        $profileJobEntity->setTo($job['to'] ?? '');
        $profileJobEntity->setTitle($job['title'] ?? '');
        $profileJobEntity->setOrganization($job['organization'] ?? '');
        $profileJobEntity->setIndustry($job['industry'] ?? '');
    }

    protected function fillLanguageEntity(IProfileEntity $profileEntity, IProfileLanguageEntity $profileLanguageEntity, array $language)
    {
        $profileLanguageEntity->setProfileId($profileEntity->getProfileId());
        $profileLanguageEntity->setLanguage($language['language'] ?? '');
        $profileLanguageEntity->setCountry($job['country'] ?? '');
    }

    protected function fillPhoneEntity(IProfileEntity $profileEntity, IProfilePhoneEntity $profilePhoneEntity, array $phone)
    {
        $profilePhoneEntity->setProfileId($profileEntity->getProfileId());
        $profilePhoneEntity->setType($phone['type'] ?? '');
        $profilePhoneEntity->setDoNotCallFlag($phone['do_not_call_flag'] ?? '');
        $profilePhoneEntity->setCountryCode($phone['country_code'] ?? '');
        $profilePhoneEntity->setOriginalNumber($phone['original_number'] ?? '');
        $profilePhoneEntity->setFormattedNumber($phone['formatted_number'] ?? '');
        $profilePhoneEntity->setValidPhone($phone['valid_phone'] ?? '');
        $profilePhoneEntity->setRiskyPhone($phone['risky_phone'] ?? '');
        $profilePhoneEntity->setDisposablePhone($phone['disposable_phone'] ?? '');
        $profilePhoneEntity->setCarrier($phone['carrier'] ?? '');
        $profilePhoneEntity->setPurpose($phone['purpose'] ?? '');
        $profilePhoneEntity->setIndustry($phone['industry'] ?? '');
    }

    protected function fillRelationshipEntity(IProfileEntity $profileEntity, IProfileRelationshipEntity $profileRelationshipEntity, array $relationship)
    {
        $profileRelationshipEntity->setProfileId($profileEntity->getProfileId());
        $profileRelationshipEntity->setValidSince($relationship['valid_since'] ?? '');
        $profileRelationshipEntity->setType($relationship['type'] ?? '');
        $profileRelationshipEntity->setFirstName($relationship['first_name'] ?? '');
        $profileRelationshipEntity->setLastName($relationship['last_name'] ?? '');
        $profileRelationshipEntity->setPersonId($relationship['person_id'] ?? '');
    }

    protected function fillSkillEntity(IProfileEntity $profileEntity, IProfileSkillEntity $profileSkillEntity, array $skill)
    {
        $profileSkillEntity->setProfileId($profileEntity->getProfileId());
        $profileSkillEntity->setProfileId($profileEntity->getProfileId());
        $profileSkillEntity->setValidSince($skill['valid_since'] ?? '');
        $profileSkillEntity->setLevel($skill['level'] ?? '');
        $profileSkillEntity->setSkill($skill['skill'] ?? '');
    }

    protected function fillSocialProfileEntity(IProfileEntity $profileEntity, IProfileSocialProfileEntity $profileSocialProfileEntity, array $socialProfile)
    {
        $profileSocialProfileEntity->setProfileId($profileEntity->getProfileId());
        $profileSocialProfileEntity->setValidSince($socialProfile['valid_since'] ?? '');
        $profileSocialProfileEntity->setUrl($socialProfile['url'] ?? '');
        $profileSocialProfileEntity->setType($socialProfile['type'] ?? '');
        $profileSocialProfileEntity->setUsername($socialProfile['username'] ?? '');
        $profileSocialProfileEntity->setAccountId($socialProfile['account_id'] ?? '');
    }

    protected function fillUsernameEntity(IProfileEntity $profileEntity, IProfileUsernameEntity $profileUsernameEntity, array $username)
    {
        $profileUsernameEntity->setProfileId($profileEntity->getProfileId());
        $profileUsernameEntity->setValidSince($username['valid_since'] ?? '');
        $profileUsernameEntity->setUsername($username['username'] ?? '');
    }
    protected function fillMetaDataEntity(IProfileEntity $profileEntity, IProfileMetaDataEntity $profileMetaDataEntity, array $meta)
    {
        $profileMetaDataEntity->setProfileId($profileEntity->getProfileId());
        $profileMetaDataEntity->setMetaKey($meta['key'] ?? '');
        $profileMetaDataEntity->setMetaValue($meta['value'] ?? '');
    }

}
