<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileMetaDataEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setMetaKey(?string $key);
    public function getMetaKey():?string;

    public function setMetaValue(?string $value);
    public function getMetaValue():?string;

}
