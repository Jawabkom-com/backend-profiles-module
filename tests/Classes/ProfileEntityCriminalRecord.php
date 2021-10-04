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
         $this->case_number = $caseNumber;
     }

     public function getCaseNumber(): string
     {
         return $this->case_number;
     }

     public function setCaseType(string $caseType)
     {
         $this->case_type = $caseType;
     }

     public function getCaseType(): string
     {
         return $this->case_type;
     }

     public function setCaseYear(string $caseYear)
     {
         $this->case_year = $caseYear;
     }

     public function getCaseYear(): string
     {
         return $this->case_year;
     }

     public function setCaseStatus(string $caseStatus)
     {
         $this->case_status = $caseStatus;
     }

     public function getCaseStatus(): string
     {
         return $this->case_status;
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
