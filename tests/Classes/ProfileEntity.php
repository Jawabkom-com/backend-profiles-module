<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityAddress;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityCriminalRecord;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityEducation;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityEmail;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityImage;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityJob;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityLanguage;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityName;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityPhone;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityRelationship;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntitySkill;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntitySocialProfile;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityUsername;

 class ProfileEntity implements IProfileEntity
{

     private mixed $id;

     public function addName(IProfileEntityName $IProfileEntityName)
     {
         $this->Name[] = $IProfileEntityName;
     }

     public function getNames(): iterable
     {
         return $this->Name;
     }

     public function addPhone(IProfileEntityPhone $IProfileEntityPhone)
     {
         $this->Phone[] = $IProfileEntityPhone;
     }

     public function getPhones(): iterable
     {
         return $this->Phone;
     }

     public function addAddress(IProfileEntityAddress $IProfileEntityAddress)
     {
         $this->Address[] = $IProfileEntityAddress;
     }

     public function getAddresses(): iterable
     {
         return $this->Address;
     }

     public function addUsername(IProfileEntityUsername $IProfileEntityUsername)
     {
        $this->Username[]=$IProfileEntityUsername;
     }

     public function getUsernames(): iterable
     {
         return $this->Username;
     }

     public function addEmail(IProfileEntityEmail $IProfileEntityEmail)
     {
         $this->Email[] =$IProfileEntityEmail;
     }

     public function getEmails(): iterable
     {
         return $this->Email;
     }

     public function addRelationship(IProfileEntityRelationship $IProfileEntityRelationship)
     {
         $this->Relationship[] =$IProfileEntityRelationship;
     }

     public function getRelationships(): iterable
     {
         return $this->Relationship;
     }

     public function addSkill(IProfileEntitySkill $IProfileEntitySkill)
     {
         $this->Skill[] =$IProfileEntitySkill;
     }

     public function getSkills(): iterable
     {
         return $this->Skill;
     }

     public function addImage(IProfileEntityImage $IProfileEntityImage)
     {
         $this->Image[] =$IProfileEntityImage;
     }

     public function getImages(): iterable
     {
         return $this->Image;
     }

     public function addLanguage(IProfileEntityLanguage $IProfileEntityLanguage)
     {
         $this->Language[] =$IProfileEntityLanguage;
     }

     public function getLanguages(): iterable
     {
         return $this->Language;
     }

     public function addJob(IProfileEntityJob $IProfileEntityJob)
     {
         $this->Job[] =$IProfileEntityJob;
     }

     public function getJobs(): iterable
     {
         return $this->Job;
     }

     public function addEducation(IProfileEntityEducation $IProfileEntityEducation)
     {
         $this->Education[] =$IProfileEntityEducation;
     }

     public function getEducations(): iterable
     {
         return $this->Education;
     }

     public function addSocialProfile(IProfileEntitySocialProfile $IProfileEntitySocialProfile)
     {
         $this->SocialProfile[] =$IProfileEntitySocialProfile;
     }

     public function getSocialProfiles(): iterable
     {
         return $this->SocialProfile;
     }

     public function addCriminalRecord(IProfileEntityCriminalRecord $IProfileEntityCriminalRecord)
     {
         $this->CriminalRecord[] =$IProfileEntityCriminalRecord;
     }

     public function getCriminalRecords(): iterable
     {
         return $this->CriminalRecord;
     }

     public function addGender(string $gender)
     {
         $this->Gender=$gender;
     }

     public function getGender(): string
     {
         return $this->Gender;
     }

     public function addDateOfBirth(\DateTime $dateOfBirth)
     {
         $this->DateOfBirth=$dateOfBirth;
     }

     public function getDateOfBirth(): \DateTime
     {
         return $this->DateOfBirth;
     }

     public function addPlaceOfBirth(string $placeOfBirth)
     {
         $this->PlaceOfBirth=$placeOfBirth;
     }

     public function getPlaceOfBirth(): string
     {
         return $this->PlaceOfBirth;
     }

     public function addDataSource(string $dataSource)
     {
         $this->DataSource=$dataSource;
     }

     public function getDataSource(): string
     {
         return $this->DataSource;
     }

     public function getProfileId(): mixed
     {
         return $this->ProfileId;
     }

     public function addProfileId(mixed $id)
     {
         $this->ProfileId = $id;
     }
 }
