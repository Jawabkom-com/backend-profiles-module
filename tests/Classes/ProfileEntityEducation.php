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

 class ProfileEntityEducation implements IProfileEntityEducation
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
 }
