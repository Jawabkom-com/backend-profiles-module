<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;


class TestSearcherWithWeeklyLimit extends TestSearcherWithOneResult
{

    public function getWeeklyRequestsLimit(): int
    {
        return 1;
    }
}
