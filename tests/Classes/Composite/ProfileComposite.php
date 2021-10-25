<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Composite;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
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

class ProfileComposite implements IProfileComposite
{

    private IProfileEntity $profile;
    private array $names;
    private array $phones;
    private array $addresses;
    private array $usernames;
    private array $emails;
    private array $relationships;
    private array $skills;
    private array $images;
    private array $languages;
    private array $jobs;
    private array $educations;
    private array $socialProfiles;
    private array $criminalRecords;
    private array $metaData;

    public function setProfile(IProfileEntity $profileEntity)
    {
        $this->profile = $profileEntity;
    }

    public function getProfile(): IProfileEntity
    {
       return $this->profile??[];
    }

    public function addName(IProfileNameEntity $IProfileEntityName)
    {
        $this->names[]= $IProfileEntityName;
    }

    public function getNames(): iterable
    {
        return $this->names??[];
    }

    public function addPhone(IProfilePhoneEntity $IProfileEntityPhone)
    {
        $this->phones[] = $IProfileEntityPhone;
    }

    public function getPhones(): iterable
    {
        return  $this->phones??[];
    }

    public function addAddress(IProfileAddressEntity $IProfileEntityAddress)
    {
        $this->addresses[] = $IProfileEntityAddress;
    }

    public function getAddresses(): iterable
    {
        return $this->addresses??[];
    }

    public function addUsername(IProfileUsernameEntity $IProfileEntityUsername)
    {
        $this->usernames[] = $IProfileEntityUsername;
    }

    public function getUsernames(): iterable
    {
        return $this->usernames??[];
    }

    public function addEmail(IProfileEmailEntity $IProfileEntityEmail)
    {
        $this->emails[] = $IProfileEntityEmail;
    }

    public function getEmails(): iterable
    {
       return $this->emails??[];
    }

    public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship)
    {
        $this->relationships[] = $IProfileEntityRelationship;
    }

    public function getRelationships(): iterable
    {
        return $this->relationships??[];
    }

    public function addSkill(IProfileSkillEntity $IProfileEntitySkill)
    {
        $this->skills[] = $IProfileEntitySkill;
    }

    public function getSkills(): iterable
    {
       return $this->skills??[];
    }

    public function addImage(IProfileImageEntity $IProfileEntityImage)
    {
        $this->images[] = $IProfileEntityImage;
    }

    public function getImages(): iterable
    {
        return $this->images??[];
    }

    public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage)
    {
        $this->languages[] = $IProfileEntityLanguage;
    }

    public function getLanguages(): iterable
    {
     return $this->languages??[];
    }

    public function addJob(IProfileJobEntity $IProfileEntityJob)
    {
        $this->jobs[] = $IProfileEntityJob;
    }

    public function getJobs(): iterable
    {
        return $this->jobs??[];
    }

    public function addEducation(IProfileEducationEntity $IProfileEntityEducation)
    {
        $this->educations[] = $IProfileEntityEducation;
    }

    public function getEducations(): iterable
    {
      return $this->educations??[];
    }

    public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile)
    {
        $this->socialProfiles[] = $IProfileEntitySocialProfile;
    }

    public function getSocialProfiles(): iterable
    {
       return $this->socialProfiles??[];
    }

    public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord)
    {
        $this->criminalRecords[] = $IProfileEntityCriminalRecord;
    }

    public function getCriminalRecords(): iterable
    {
      return  $this->criminalRecords??[];
    }

    public function addMetaData(IProfileMetaDataEntity $profileMetaDataEntity)
    {
        $this->metaData[] = $profileMetaDataEntity;
    }

    public function getMetaData(): iterable
    {
        return $this->metaData??[];
    }

    public function setNames(iterable $names)
    {
        // TODO: Implement setNames() method.
    }

    public function setPhones(iterable $phones)
    {
        // TODO: Implement setPhones() method.
    }

    public function setAddresses(iterable $addresses)
    {
        // TODO: Implement setAddresses() method.
    }

    public function setUsernames(iterable $usernames)
    {
        // TODO: Implement setUsernames() method.
    }

    public function setEmails(iterable $emails)
    {
        // TODO: Implement setEmails() method.
    }

    public function setSkills(iterable $skills)
    {
        // TODO: Implement setSkills() method.
    }

    public function setImages(iterable $images)
    {
        // TODO: Implement setImages() method.
    }

    public function setLanguages(iterable $languages)
    {
        // TODO: Implement setLanguages() method.
    }

    public function setJobs(iterable $jobs)
    {
        // TODO: Implement setJobs() method.
    }

    public function setEducations(iterable $educations)
    {
        // TODO: Implement setEducations() method.
    }

    public function setSocialProfiles(iterable $SocialProfiles)
    {
        // TODO: Implement setSocialProfiles() method.
    }

    public function setCriminalRecords(iterable $criminalRecords)
    {
        // TODO: Implement setCriminalRecords() method.
    }

    public function setMetaData(iterable $metaData)
    {
        // TODO: Implement setMetaData() method.
    }
}