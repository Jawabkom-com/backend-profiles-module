<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileSearcher
{
    public function getHourlyRequestsLimit():int;
    public function getDailyRequestsLimit():int;
    public function getWeeklyRequestsLimit():int;
    public function getMonthlyRequestsLimit():int;
    public function search(array $filters):mixed;
}
