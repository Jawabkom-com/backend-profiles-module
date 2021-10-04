<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityUsername
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setUsername(string $username);
    public function getUsername():string;

}
