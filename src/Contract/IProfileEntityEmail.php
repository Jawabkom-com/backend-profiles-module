<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityEmail
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setEmail(string $email);
    public function getEmail():string;

    public function setEspDomain(string $espDomain);
    public function getEspDomain():string;

    public function setType(string $type);
    public function getType():string;

}
