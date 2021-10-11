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

 class ProfilePhoneEntity implements IProfilePhoneEntity
 {


     public function setCreatedAt(\DateTime $createdAt)
     {
         $this->createdAt = $createdAt;
     }

     public function getCreatedAt(): \DateTime
     {
         return $this->createdAt;
     }

     public function setUpdatedAt(\DateTime $updatedAt)
     {
         $this->updatedAt = $updatedAt;
     }

     public function getUpdatedAt(): \DateTime
     {
         return $this->updatedAt;
     }

     public function setType(string $type)
     {
         $this->type = $type;
     }

     public function getType(): string
     {
         return $this->type;
     }

     public function setDoNotCallFlag(bool $doNotCallFlag)
     {
         $this->doNotCallFlag = $doNotCallFlag;
     }

     public function getDoNotCallFlag(): bool
     {
         return $this->doNotCallFlag;
     }

     public function setCountryCode(string $countryCode)
     {
         $this->countryCode = $countryCode;
     }

     public function getCountryCode(): string
     {
         return $this->countryCode;
     }

     public function setOriginalNumber(string $originalNumber)
     {
         $this->originalNumber = $originalNumber;
     }

     public function getOriginalNumber(): string
     {
         return $this->originalNumber;
     }

     public function setFormattedNumber(string $formattedNumber)
     {
         $this->formattedNumber = $formattedNumber;
     }

     public function getFormattedNumber(): string
     {
         return $this->formattedNumber;
     }

     public function setValidPhone(bool $validPhone)
     {
         $this->validPhone = $validPhone;
     }

     public function getValidPhone(): bool
     {
         return $this->validPhone;
     }

     public function setRiskyPhone(bool $riskyPhone)
     {
         $this->riskyPhone = $riskyPhone;
     }

     public function getRiskyPhone(): bool
     {
         return $this->riskyPhone;
     }

     public function setDisposablePhone(bool $disposablePhone)
     {
         $this->disposablePhone = $disposablePhone;
     }

     public function getDisposablePhone(): bool
     {
         return $this->disposablePhone;
     }

     public function setCarrier(string $carrier)
     {
         $this->carrier = $carrier;
     }

     public function getCarrier(): string
     {
         return $this->carrier;
     }

     public function setPurpose(string $purpose)
     {
         $this->purpose = $purpose;
     }

     public function getPurpose(): string
     {
         return $this->purpose;
     }

     public function setIndustry(string $industry)
     {
         $this->industry = $industry;
     }

     public function getIndustry(): string
     {
         return $this->industry;
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
