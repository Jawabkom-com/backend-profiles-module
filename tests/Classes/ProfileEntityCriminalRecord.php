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
         $this->caseNumber = $caseNumber;
     }

     public function getCaseNumber(): string
     {
         return $this->caseNumber;
     }

     public function setCaseType(string $caseType)
     {
         $this->caseType = $caseType;
     }

     public function getCaseType(): string
     {
         return $this->caseType;
     }

     public function setCaseYear(string $caseYear)
     {
         $this->caseYear = $caseYear;
     }

     public function getCaseYear(): string
     {
         return $this->caseYear;
     }

     public function setCaseStatus(string $caseStatus)
     {
         $this->caseStatus = $caseStatus;
     }

     public function getCaseStatus(): string
     {
         return $this->caseStatus;
     }

     public function setDisplay(string $display)
     {
         $this->display = $display;
     }

     public function getDisplay(): string
     {
         return $this->display;
     }
 }
