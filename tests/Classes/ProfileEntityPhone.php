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

 class ProfileEntityPhone implements IProfileEntityPhone
 {


     public function setCreatedAt(\DateTime $createdAt)
     {
         $this->created_at = $createdAt;
     }

     public function getCreatedAt(): \DateTime
     {
         return $this->created_at;
     }

     public function setUpdatedAt(\DateTime $updatedAt)
     {
         $this->updated_at = $updatedAt;
     }

     public function getUpdatedAt(): \DateTime
     {
         return $this->updated_at;
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
         $this->do_not_call_flag = $doNotCallFlag;
     }

     public function getDoNotCallFlag(): bool
     {
         return $this->do_not_call_flag;
     }

     public function setCountryCode(string $countryCode)
     {
         $this->country_code = $countryCode;
     }

     public function getCountryCode(): string
     {
         return $this->country_code;
     }

     public function setOriginalNumber(string $originalNumber)
     {
         $this->original_number = $originalNumber;
     }

     public function getOriginalNumber(): string
     {
         return $this->original_number;
     }

     public function setFormattedNumber(string $formattedNumber)
     {
         $this->formatted_number = $formattedNumber;
     }

     public function getFormattedNumber(): string
     {
         return $this->formatted_number;
     }

     public function setValidPhone(bool $validPhone)
     {
         $this->valid_phone = $validPhone;
     }

     public function getValidPhone(): bool
     {
         return $this->valid_phone;
     }

     public function setRiskyPhone(bool $riskyPhone)
     {
         $this->risky_phone = $riskyPhone;
     }

     public function getRiskyPhone(): bool
     {
         return $this->risky_phone;
     }

     public function setDisposablePhone(bool $disposablePhone)
     {
         $this->disposable_phone = $disposablePhone;
     }

     public function getDisposablePhone(): bool
     {
         return $this->disposable_phone;
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
 }
