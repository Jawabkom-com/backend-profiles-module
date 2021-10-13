<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityMapper;

class TestSearcherMapper implements IProfileEntityMapper
{

    /**
     * @param mixed $searchResult
     * @return IProfileEntity[]
     */
    public function map(mixed $searchResult): iterable
    {
        dd($searchResult);
    }
}
