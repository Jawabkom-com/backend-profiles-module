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

 class ProfileEntityRelationship implements IProfileEntityRelationship
 {

     public function setValidSince(\DateTime $validSince)
     {
         $this->validSince = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->validSince;
     }

     public function setType(string $type)
     {
         $this->type = $type;
     }

     public function getType(): string
     {
         return $this->type;
     }

     public function setFirstName(string $firstName)
     {
         $this->firstName = $firstName;
     }

     public function getFirstName(): string
     {
         return $this->firstName;
     }

     public function setLastName(string $lastName)
     {
         $this->lastName = $lastName;
     }

     public function getLastName(): string
     {
         return $this->lastName;
     }

     public function setPersonId(string $personId)
     {
         $this->personId = $personId;
     }

     public function getPersonId(): string
     {
         return $this->personId;
     }
 }
