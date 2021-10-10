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

 class ProfileImageEntity implements IProfileImageEntity
 {

     public function setOriginalUrl(string $originalUrl)
     {
         $this->originalUrl = $originalUrl;
     }

     public function getOriginalUrl(): string
     {
         return $this->originalUrl;
     }

     public function setLocalPath(string $localPath)
     {
         $this->localPath = $localPath;
     }

     public function getLocalPath(): string
     {
         return $this->localPath;
     }

     public function setValidSince(\DateTime $validSince)
     {
         $this->validSince = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->validSince;
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
