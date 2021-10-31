<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfilePhoneEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(?\DateTime $validSince);
    public function getValidSince():?\DateTime;

    public function setType(?string $type);
    public function getType():?string;

    public function setDoNotCallFlag(?bool $doNotCallFlag);
    public function getDoNotCallFlag():?bool;

    public function setCountryCode(?string $countryCode);
    public function getCountryCode():?string;

    public function setOriginalNumber(?string $originalNumber);
    public function getOriginalNumber():?string;

    public function setFormattedNumber(?string $formattedNumber);
    public function getFormattedNumber():?string;

    public function setValidPhone(?bool $validPhone);
    public function getValidPhone():?bool;

    public function setRiskyPhone(?bool $riskyPhone);
    public function getRiskyPhone():?bool;

    public function setDisposablePhone(?bool $disposablePhone);
    public function getDisposablePhone():?bool;

    public function setCarrier(?string $carrier);
    public function getCarrier():?string;

    public function setPurpose(?string $purpose);
    public function getPurpose():?string;

    public function setIndustry(?string $industry);
    public function getIndustry():?string;

    public function setHash(string $hash);
    public function getHash():string;

    public function addPossibleCountries(iterable $countries);
    public function getPossibleCountries():iterable;

}
