<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileLanguageEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setLanguage(?string $language);
    public function getLanguage():?string;

    public function setCountry(?string $country);
    public function getCountry():?string;

    public function setHash(string $hash);
    public function getHash():string;

}
