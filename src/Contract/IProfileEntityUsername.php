<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntityUsername
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setUsername(string $username);
    public function getUsername():string;

}
