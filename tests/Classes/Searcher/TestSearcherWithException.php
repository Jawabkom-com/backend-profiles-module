<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSearcher;
use Jawabkom\Standard\Contract\IFilterComposite;

class TestSearcherWithException implements IProfileSearcher
{

    public function search(IFilterComposite $filters): mixed
    {
        throw new \Exception('Searcher with Exception Test');
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
