<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityUsername
{
    public function setValidSince(string $validSince);
    public function getValidSince():string;

    public function setUsername(string $username);
    public function getUsername():string;

}
