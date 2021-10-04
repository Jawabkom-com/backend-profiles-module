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
         // TODO: Implement setValidSince() method.
     }

     public function getValidSince(): \DateTime
     {
         // TODO: Implement getValidSince() method.
     }

     public function setEmail(string $email)
     {
         // TODO: Implement setEmail() method.
     }

     public function getEmail(): string
     {
         // TODO: Implement getEmail() method.
     }

     public function setEspDomain(string $EspDomain)
     {
         // TODO: Implement setEspDomain() method.
     }

     public function getEspDomain(): string
     {
         // TODO: Implement getEspDomain() method.
     }

     public function setType(string $type)
     {
         // TODO: Implement setType() method.
     }

     public function getType(): string
     {
         // TODO: Implement getType() method.
     }
 }
