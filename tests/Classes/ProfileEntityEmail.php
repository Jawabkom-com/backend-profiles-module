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
         $this->validSince = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->validSince;
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
         $this->espAdmin = $espDomain;
     }

     public function getEspDomain(): string
     {
         return $this->espAdmin;
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
