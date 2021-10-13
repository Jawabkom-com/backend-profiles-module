<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;


class TestSearcherWithHourlyLimit extends TestSearcherWithOneResult
{

    public function getHourlyRequestsLimit(): int
    {
        return 1;
    }
}
