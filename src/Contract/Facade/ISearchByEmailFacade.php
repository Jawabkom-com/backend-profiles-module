<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Facade;

use Jawabkom\Backend\Module\Profile\SearcherRegistry;

interface ISearchByEmailFacade
{
    public function searchByEmail(string $email,$advanceFilter=[],array $alias =[],SearcherRegistry $searcherRegistry = null):iterable;
}