<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityImage
{
    public function setOriginalUrl(string $originalUrl);
    public function getOriginalUrl():string;

    public function setLocalPath(string $localPath);
    public function getLocalPath():string;

    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

}
