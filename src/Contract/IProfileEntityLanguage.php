<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityLanguage
{
    public function setLanguage(string $language);
    public function getLanguage():string;

    public function setCountry(string $country);
    public function getCountry():string;

}
