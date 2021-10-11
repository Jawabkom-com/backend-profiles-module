<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
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
        $profileNameEntity->setFirst($name['first'] ?? '');
        $profileNameEntity->setMiddle($name['middle'] ?? '');
        $profileNameEntity->setLast($name['last'] ?? '');
        $profileNameEntity->setPrefix($name['prefix'] ?? '');
        $displayName = preg_replace('#[\s]+#', ' ', trim($profileNameEntity->getPrefix() . ' ' . $profileNameEntity->getFirst() . ' ' . $profileNameEntity->getMiddle() . ' ' . $profileNameEntity->getLast()));
        $profileNameEntity->setDisplay($displayName);
    }

    protected function fillAddressEntity(IProfileEntity $profileEntity, IProfileAddressEntity $profileAddressEntity, array $address)
    {
        $profileAddressEntity->setValidSince($address['validSince'] ?? '');
        $profileAddressEntity->setCountry($address['country'] ?? '');
        $profileAddressEntity->setState($address['state'] ?? '');
        $profileAddressEntity->setCity($address['city'] ?? '');
        $profileAddressEntity->setZip($address['zip'] ?? '');
        $profileAddressEntity->setStreet($address['street'] ?? '');
        $profileAddressEntity->setBuildingNumber($address['buildingNumber'] ?? '');
        $profileAddressEntity->setDisplay($address['display'] ?? '');
    }

    protected function fillCriminalRecordEntity(IProfileEntity $profileEntity, IProfileCriminalRecordEntity $profileCriminalRecordEntity, array $criminalRecord)
    {
        $profileCriminalRecordEntity->setCaseNumber($criminalRecord['caseNumber'] ?? '');
        $profileCriminalRecordEntity->setCaseType($criminalRecord['caseType'] ?? '');
        $profileCriminalRecordEntity->setCaseYear($criminalRecord['caseYear'] ?? '');
        $profileCriminalRecordEntity->setCaseStatus($criminalRecord['caseStatus'] ?? '');
        $profileCriminalRecordEntity->setDisplay($criminalRecord['display'] ?? '');
    }

    protected function fillEducationEntity(IProfileEntity $profileEntity, IProfileEducationEntity $profileEducationEntity, array $education)
    {
        $profileEducationEntity->setValidSince($education['validSince'] ?? '');
        $profileEducationEntity->setFrom($education['from'] ?? '');
        $profileEducationEntity->setTo($education['to'] ?? '');
        $profileEducationEntity->setSchool($education['school'] ?? '');
        $profileEducationEntity->setDegree($education['degree'] ?? '');;
        $profileEducationEntity->setMajor($education['major'] ?? '');;
    }

    protected function fillEmailEntity(IProfileEntity $profileEntity, IProfileEmailEntity $profileEmailEntity, array $email)
    {
        $profileEmailEntity->setValidSince($email['validSince'] ?? '');
        $profileEmailEntity->setEmail($email['email'] ?? '');
        $profileEmailEntity->setEspDomain($email['espDomain'] ?? '');
        $profileEmailEntity->setType($email['type'] ?? '');
    }

    protected function fillImageEntity(IProfileEntity $profileEntity, IProfileImageEntity $profileImageEntity, array $image)
    {
        $profileImageEntity->setOriginalUrl($image['originalUrl'] ?? '');
        $profileImageEntity->setLocalPath($image['localPath'] ?? '');
        $profileImageEntity->setValidSince($image['validSince'] ?? '');
    }

    protected function fillJobEntity(IProfileEntity $profileEntity, IProfileJobEntity $profileJobEntity, array $job)
    {
        $profileJobEntity->setValidSince($job['validSince'] ?? '');
        $profileJobEntity->setFrom($job['from'] ?? '');
        $profileJobEntity->setTo($job['to'] ?? '');
        $profileJobEntity->setTitle($job['title'] ?? '');
        $profileJobEntity->setOrganization($job['organization'] ?? '');
        $profileJobEntity->setIndustry($job['industry'] ?? '');
    }

    protected function fillLanguageEntity(IProfileEntity $profileEntity, IProfileLanguageEntity $profileLanguageEntity, array $language)
    {
        $profileLanguageEntity->setLanguage($language['language'] ?? '');
        $profileLanguageEntity->setCountry($job['country'] ?? '');
    }

    protected function fillPhoneEntity(IProfileEntity $profileEntity, IProfilePhoneEntity $profilePhoneEntity, array $phone)
    {
        $profilePhoneEntity->setCreatedAt($phone['createdAt'] ?? '');
        $profilePhoneEntity->setUpdatedAt($phone['updatedAt'] ?? '');
        $profilePhoneEntity->setType($phone['type'] ?? '');
        $profilePhoneEntity->setDoNotCallFlag($phone['doNotCallFlag'] ?? '');
        $profilePhoneEntity->setCountryCode($phone['countryCode'] ?? '');
        $profilePhoneEntity->setOriginalNumber($phone['originalNumber'] ?? '');
        $profilePhoneEntity->setFormattedNumber($phone['formattedNumber'] ?? '');
        $profilePhoneEntity->setValidPhone($phone['validPhone'] ?? '');
        $profilePhoneEntity->setRiskyPhone($phone['riskyPhone'] ?? '');
        $profilePhoneEntity->setDisposablePhone($phone['disposablePhone'] ?? '');
        $profilePhoneEntity->setCarrier($phone['carrier'] ?? '');
        $profilePhoneEntity->setPurpose($phone['purpose'] ?? '');
        $profilePhoneEntity->setIndustry($phone['industry'] ?? '');
    }

    protected function fillRelationshipEntity(IProfileEntity $profileEntity, IProfileRelationshipEntity $profileRelationshipEntity, array $relationship)
    {
        $profileRelationshipEntity->setValidSince($relationship['validSince'] ?? '');
        $profileRelationshipEntity->setType($relationship['type'] ?? '');
        $profileRelationshipEntity->setFirstName($relationship['firstName'] ?? '');
        $profileRelationshipEntity->setLastName($relationship['lastName'] ?? '');
        $profileRelationshipEntity->setPersonId($relationship['personId'] ?? '');
    }

    protected function fillSkillEntity(IProfileEntity $profileEntity, IProfileSkillEntity $profileSkillEntity, array $skill)
    {
        $profileSkillEntity->setValidSince($skill['validSince'] ?? '');
        $profileSkillEntity->setLevel($skill['level'] ?? '');
        $profileSkillEntity->setSkill($skill['skill'] ?? '');
    }

    protected function fillSocialProfileEntity(IProfileEntity $profileEntity, IProfileSocialProfileEntity $profileSocialProfileEntity, array $socialProfile)
    {
        $profileSocialProfileEntity->setValidSince($socialProfile['validSince'] ?? '');
        $profileSocialProfileEntity->setUrl($socialProfile['url'] ?? '');
        $profileSocialProfileEntity->setType($socialProfile['type'] ?? '');
        $profileSocialProfileEntity->setUsername($socialProfile['username'] ?? '');
        $profileSocialProfileEntity->setAccountId($socialProfile['accountId'] ?? '');
    }

    protected function fillUsernameEntity(IProfileEntity $profileEntity, IProfileUsernameEntity $profileUsernameEntity, array $username)
    {
        $profileUsernameEntity->setValidSince($username['validSince'] ?? '');
        $profileUsernameEntity->setUsername($username['username'] ?? '');
    }

}
