<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IQueryRequestLoggerEntity extends IEntity
{

    public function setRequestFilters(array $filter);
    public function getRequestFilters():array;


    public function setRequestDateTime(\DateTime $dateTime);
    public function getRequestDateTime():\DateTime;

    public function setOtherParams(array $params);
    public function getOtherParams():array;

    public function setMatchesCount(int $count);
    public function getMatchesCount():int;

    public function setStatus(string $status);
    public function getStatus():string;

    public function setRequestMeta(array $meta);
    public function getRequestMeta():array;

    public function addError(string $message);

    /**
     * @return string[]
     */
    public function getErrors():iterable;

}
