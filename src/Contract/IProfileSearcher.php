<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileSearcher
{
    public function getDailyRequestsLimit():int;
    public function search(array $filters):mixed;
}
