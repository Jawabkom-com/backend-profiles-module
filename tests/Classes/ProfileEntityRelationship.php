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
         // TODO: Implement setValidSince() method.
     }

     public function getValidSince(): \DateTime
     {
         // TODO: Implement getValidSince() method.
     }

     public function setType(string $type)
     {
         // TODO: Implement setType() method.
     }

     public function getType(): string
     {
         // TODO: Implement getType() method.
     }

     public function setFirstName(string $firstName)
     {
         // TODO: Implement setFirstName() method.
     }

     public function getFirstName(): string
     {
         // TODO: Implement getFirstName() method.
     }

     public function setLastName(string $lastName)
     {
         // TODO: Implement setLastName() method.
     }

     public function getLastName(): string
     {
         // TODO: Implement getLastName() method.
     }

     public function setPersonId(string $personId)
     {
         // TODO: Implement setPersonId() method.
     }

     public function getPersonId(): string
     {
         // TODO: Implement getPersonId() method.
     }
 }
