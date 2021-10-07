<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

 class ProfileCriminalRecordEntity implements IProfileCriminalRecordEntity
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
