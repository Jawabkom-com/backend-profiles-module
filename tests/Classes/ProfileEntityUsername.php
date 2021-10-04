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

 class ProfileEntityUsername implements IProfileEntityUsername
 {

     public function setValidSince(\DateTime $validSince)
     {
         // TODO: Implement setValidSince() method.
     }

     public function getValidSince(): \DateTime
     {
         // TODO: Implement getValidSince() method.
     }

     public function setUsername(string $username)
     {
         // TODO: Implement setUsername() method.
     }

     public function getUsername(): string
     {
         // TODO: Implement getUsername() method.
     }
 }
