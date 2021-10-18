<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface ISearcherStatusEntity extends IEntity
{
    public function getSearcherAlias():string;
    public function setSearcherAlias(string $alias);

    public function getStatusYear():int;
    public function setStatusYear(int $year);

    public function getStatusMonth():int;
    public function setStatusMonth(int $month);

    public function getStatusDay():int;
    public function setStatusDay(int $day);

    public function getStatusHour():int; // range 0 - 23
    public function setStatusHour(int $hour);

    public function getCounter():int;
    public function setCounter(int $counter);

}
