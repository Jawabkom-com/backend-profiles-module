<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileImageEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setOriginalUrl(string $originalUrl);
    public function getOriginalUrl():string;

    public function setLocalPath(string $localPath);
    public function getLocalPath():string;

    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

}
