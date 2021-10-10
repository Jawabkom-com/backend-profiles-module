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

 class ProfileNameEntity implements IProfileNameEntity
 {

     public function setPrefix(string $prefix)
     {
         $this->prefix = $prefix;
     }

     public function getPrefix(): string
     {
         return $this->prefix;
     }

     public function setFirst(string $first)
     {
         $this->first = $first;
     }

     public function getFirst(): string
     {
         return $this->first;
     }

     public function setMiddle(string $middle)
     {
         $this->middle = $middle;
     }

     public function getMiddle(): string
     {
         return $this->middle;
     }

     public function setLast(string $last)
     {
         $this->last = $last;
     }

     public function getLast(): string
     {
         return $this->last;
     }

     public function setDisplay(string $display)
     {
         $this->display = $display;
     }

     public function getDisplay(): string
     {
         return $this->display;
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
