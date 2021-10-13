<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;


class TestSearcherWithMonthlyLimit extends TestSearcherWithOneResult
{

    public function getMonthlyRequestsLimit(): int
    {
        return 1;
    }
}
