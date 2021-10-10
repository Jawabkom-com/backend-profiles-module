<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

 class ProfileEntity implements IProfileEntity
{

     private mixed $id;

     public function addName(IProfileNameEntity $IProfileEntityName)
     {
         $this->Name[] = $IProfileEntityName;
     }

     public function getNames(): iterable
     {
         return $this->Name;
     }

     public function addPhone(IProfilePhoneEntity $IProfileEntityPhone)
     {
         $this->Phone[] = $IProfileEntityPhone;
     }

     public function getPhones(): iterable
     {
         return $this->Phone;
     }

     public function addAddress(IProfileAddressEntity $IProfileEntityAddress)
     {
         $this->Address[] = $IProfileEntityAddress;
     }

     public function getAddresses(): iterable
     {
         return $this->Address;
     }

     public function addUsername(IProfileUsernameEntity $IProfileEntityUsername)
     {
        $this->Username[]=$IProfileEntityUsername;
     }

     public function getUsernames(): iterable
     {
         return $this->Username;
     }

     public function addEmail(IProfileEmailEntity $IProfileEntityEmail)
     {
         $this->Email[] =$IProfileEntityEmail;
     }

     public function getEmails(): iterable
     {
         return $this->Email;
     }

     public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship)
     {
         $this->Relationship[] =$IProfileEntityRelationship;
     }

     public function getRelationships(): iterable
     {
         return $this->Relationship;
     }

     public function addSkill(IProfileSkillEntity $IProfileEntitySkill)
     {
         $this->Skill[] =$IProfileEntitySkill;
     }

     public function getSkills(): iterable
     {
         return $this->Skill;
     }

     public function addImage(IProfileImageEntity $IProfileEntityImage)
     {
         $this->Image[] =$IProfileEntityImage;
     }

     public function getImages(): iterable
     {
         return $this->Image;
     }

     public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage)
     {
         $this->Language[] =$IProfileEntityLanguage;
     }

     public function getLanguages(): iterable
     {
         return $this->Language;
     }

     public function addJob(IProfileJobEntity $IProfileEntityJob)
     {
         $this->Job[] =$IProfileEntityJob;
     }

     public function getJobs(): iterable
     {
         return $this->Job;
     }

     public function addEducation(IProfileEducationEntity $IProfileEntityEducation)
     {
         $this->Education[] =$IProfileEntityEducation;
     }

     public function getEducations(): iterable
     {
         return $this->Education;
     }

     public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile)
     {
         $this->SocialProfile[] =$IProfileEntitySocialProfile;
     }

     public function getSocialProfiles(): iterable
     {
         return $this->SocialProfile;
     }

     public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord)
     {
         $this->CriminalRecord[] =$IProfileEntityCriminalRecord;
     }

     public function getCriminalRecords(): iterable
     {
         return $this->CriminalRecord;
     }

     public function setGender(string $gender)
     {
         $this->Gender=$gender;
     }

     public function getGender(): string
     {
         return $this->Gender;
     }

     public function setDateOfBirth(\DateTime $dateOfBirth)
     {
         $this->DateOfBirth=$dateOfBirth;
     }

     public function getDateOfBirth(): \DateTime
     {
         return $this->DateOfBirth;
     }

     public function setPlaceOfBirth(string $placeOfBirth)
     {
         $this->PlaceOfBirth=$placeOfBirth;
     }

     public function getPlaceOfBirth(): string
     {
         return $this->PlaceOfBirth;
     }

     public function setDataSource(string $dataSource)
     {
         $this->DataSource=$dataSource;
     }

     public function getDataSource(): string
     {
         return $this->DataSource;
     }

     public function getProfileId(): int|string
     {
         return $this->ProfileId;
     }

     public function addProfileId(mixed $id)
     {
         $this->ProfileId = $id;
     }

     public function setProfileId(int|string $id)
     {
         $this->profileId = $id;
     }
 }
