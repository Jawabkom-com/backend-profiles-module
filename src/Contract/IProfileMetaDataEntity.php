<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileMetaDataEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setMetaKey(?string $metaKey);
    public function getMetaKey():?string;

    public function setMetaValue(?string $metaValue);
    public function getMetaValue():?string;

    public function setHash(string $hash);
    public function getHash():string;

}
