<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntityMapper
{
    /**
     * @param mixed $searchResult
     * @return IProfileEntity[]
     */
    public function map(mixed $searchResult):iterable;
}
