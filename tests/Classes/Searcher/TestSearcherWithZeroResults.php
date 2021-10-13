<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSearcher;

class TestSearcherWithZeroResults implements IProfileSearcher
{

    public function search(array $filters): mixed
    {
        return [];
    }

    public function getDailyRequestsLimit(): int
    {
        return 0;
    }

    public function getHourlyRequestsLimit(): int
    {
        return 0;
    }

    public function getWeeklyRequestsLimit(): int
    {
        return 0;
    }

    public function getMonthlyRequestsLimit(): int
    {
        return 0;
    }
}
