<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntityMapper
{
    public function map(mixed $searchResult):iterable;
}