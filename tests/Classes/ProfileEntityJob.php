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

 class ProfileEntityJob implements IProfileEntityJob
 {

     public function setValidSince(\DateTime $validSince)
     {
         $this->valid_since = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->valid_sence;
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
