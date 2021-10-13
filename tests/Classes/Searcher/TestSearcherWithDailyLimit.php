<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;


class TestSearcherWithDailyLimit extends TestSearcherWithOneResult
{

    public function getDailyRequestsLimit(): int
    {
        return 1;
    }
}
