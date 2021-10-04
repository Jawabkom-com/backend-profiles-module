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

 class ProfileEntitySkill implements IProfileEntitySkill
 {

     public function setValidSince(\DateTime $validSince)
     {
         // TODO: Implement setValidSince() method.
     }

     public function getValidSince(): \DateTime
     {
         // TODO: Implement getValidSince() method.
     }

     public function setLevel(string $level)
     {
         // TODO: Implement setLevel() method.
     }

     public function getLevel(): string
     {
         // TODO: Implement getLevel() method.
     }

     public function setSkill(string $skill)
     {
         // TODO: Implement setSkill() method.
     }

     public function getSkill(): string
     {
         // TODO: Implement getSkill() method.
     }
 }
