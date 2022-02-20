<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IFilterComposite;

interface IProfileSearcher
{
    public function getHourlyRequestsLimit():int;
    public function getDailyRequestsLimit():int;
    public function getWeeklyRequestsLimit():int;
    public function getMonthlyRequestsLimit():int;
    public function search(IFilterComposite $filters):mixed;
    public function canBreakChain(mixed $searchResult):bool;
}
