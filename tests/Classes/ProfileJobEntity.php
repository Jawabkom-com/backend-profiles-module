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

 class ProfileJobEntity implements IProfileJobEntity
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

     public function setTitle(string $title)
     {
         $this->title = $title;
     }

     public function getTitle(): string
     {
         return $this->title;
     }

     public function setOrganization(string $organization)
     {
         $this->organization = $organization;
     }

     public function getOrganization(): string
     {
         return $this->organization;
     }

     public function setIndustry(string $industry)
     {
         $this->industry = $industry;
     }

     public function getIndustry(): string
     {
         return $this->industry;
     }
 }
