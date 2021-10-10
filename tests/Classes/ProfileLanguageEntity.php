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

 class ProfileLanguageEntity implements IProfileLanguageEntity
 {

     public function setLanguage(string $language)
     {
         $this->language = $language;
     }

     public function getLanguage(): string
     {
         return $this->language;
     }

     public function setCountry(string $country)
     {
         $this->country = $country;
     }

     public function getCountry(): string
     {
         return $this->country;
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
