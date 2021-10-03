<?php

namespace Jawabkom\Backend\Module\Profile\Contract;


interface IProfileEntityPhone
{
    public function setCreatedAt(\DateTime $createdAt);
    public function getCreatedAt():\DateTime;

    public function setUpdatedAt(\DateTime $updatedAt);
    public function getUpdatedAt():\DateTime;

    public function setType(string $type);
    public function getType():string;

    public function setDoNotCallFlag(bool $doNotCallFlag);
    public function getDoNotCallFlag():bool;

    public function setCountryCode(string $countryCode);
    public function getCountryCode():string;

    public function setOriginalNumber(string $originalNumber);
    public function getOriginalNumber():string;

    public function setFormattedNumber(string $formattedNumber);
    public function getFormattedNumber():string;

    public function setValidPhone(bool $validPhone);
    public function getValidPhone():bool;

    public function setRiskyPhone(bool $riskyPhone);
    public function getRiskyPhone():bool;

    public function setDisposablePhone(bool $disposablePhone);
    public function getDisposablePhone():bool;

    public function setCarrier(bool $carrier);
    public function getCarrier():bool;

    public function setPurpose(bool $purpose);
    public function getPurpose():bool;

    public function setIndustry(bool $industry);
    public function getIndustry():bool;

}
