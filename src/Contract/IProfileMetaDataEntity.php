<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileMetaDataEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setKey(string $key);
    public function getKey():string;

    public function setValue(string $value);
    public function getValue():string;

}
