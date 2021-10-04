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
         $this->valid_since = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->valid_sence;
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
         $this->first_name = $firstName;
     }

     public function getFirstName(): string
     {
         return $this->first_name;
     }

     public function setLastName(string $lastName)
     {
         $this->last_name = $lastName;
     }

     public function getLastName(): string
     {
         return $this->last_name;
     }

     public function setPersonId(string $personId)
     {
         $this->person_id = $personId;
     }

     public function getPersonId(): string
     {
         return $this->person_id;
     }
 }
