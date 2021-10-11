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

 class ProfileEducationEntity implements IProfileEducationEntity
 {

     public function setValidSince(\DateTime $validSince)
     {
         $this->validSince = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->validSince;
     }

     public function setFrom(string $from)
     {
         $this->from = $from;
     }

     public function getFrom(): string
     {
         return $this->from;
     }

     public function setTo(string $to)
     {
         $this->to = $to;
     }

     public function getTo(): string
     {
         return $this->to;
     }

     public function setSchool(string $school)
     {
         $this->school = $school;
     }

     public function getSchool(): string
     {
         return $this->school;
     }

     public function setDegree(string $degree)
     {
         $this->degree = $degree;
     }

     public function getDegree(): string
     {
         return $this->degree;
     }

     public function setMajor(string $major)
     {
         $this->major = $major;
     }

     public function getMajor(): string
     {
         return $this->major;
     }

     public function getProfileId(): int|string
     {
         return $this->profileId;
     }

     public function setProfileId(int|string $id)
     {
         $this->profileId = $id;
     }
 }
