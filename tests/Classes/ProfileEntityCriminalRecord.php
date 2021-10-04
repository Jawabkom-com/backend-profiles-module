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

 class ProfileEntityCriminalRecord implements IProfileEntityCriminalRecord
 {

     public function setCaseNumber(string $caseNumber)
     {
         // TODO: Implement setCaseNumber() method.
     }

     public function getCaseNumber(): string
     {
         // TODO: Implement getCaseNumber() method.
     }

     public function setCaseType(string $caseType)
     {
         // TODO: Implement setCaseType() method.
     }

     public function getCaseType(): string
     {
         // TODO: Implement getCaseType() method.
     }

     public function setCaseYear(string $caseYear)
     {
         // TODO: Implement setCaseYear() method.
     }

     public function getCaseYear(): string
     {
         // TODO: Implement getCaseYear() method.
     }

     public function setCaseStatus(string $caseStatus)
     {
         // TODO: Implement setCaseStatus() method.
     }

     public function getCaseStatus(): string
     {
         // TODO: Implement getCaseStatus() method.
     }

     public function setDisplay(string $display)
     {
         // TODO: Implement setDisplay() method.
     }

     public function getDisplay(): string
     {
         // TODO: Implement getDisplay() method.
     }
 }
