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

 class ProfileEntityEmail implements IProfileEntityEmail
 {

     public function setValidSince(\DateTime $validSince)
     {
         $this->valid_since = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->valid_sence;
     }

     public function setEmail(string $email)
     {
         $this->email = $email;
     }

     public function getEmail(): string
     {
         return $this->email;
     }

     public function setEspDomain(string $espDomain)
     {
         $this->esp_admin = $espDomain;
     }

     public function getEspDomain(): string
     {
         return $this->esp_admin;
     }

     public function setType(string $type)
     {
         $this->type = $type;
     }

     public function getType(): string
     {
         return $this->type;
     }
 }
