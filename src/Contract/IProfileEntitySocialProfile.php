<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntitySocialProfile
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setUrl(string $url);
    public function getUrl():string;

    public function setType(string $type);
    public function getType():string;

    public function setUsername(string $username);
    public function getUsername():string;

    public function setAccountId(string $accountId);
    public function getAccountId():string;

}
