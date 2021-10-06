<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface ISearchRequestEntity extends IEntity
{

    public function setHash(string $hash);
    public function getHash():string;

    public function setRequestParams(array $request);
    public function getRequestParams():array;


}
