<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;


class TestSearcherWithDailyTwiceLimit extends TestSearcherWithOneResult
{

    public function getDailyRequestsLimit(): int
    {
        return 2;
    }
}
