<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileNameEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setPrefix(string $prefix);
    public function getPrefix():string;

    public function setFirst(string $first);
    public function getFirst():string;

    public function setMiddle(string $middle);
    public function getMiddle():string;

    public function setLast(string $last);
    public function getLast():string;

    public function setDisplay(string $display);
    public function getDisplay():string;

}
