<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Service\SearchOnlineBySearchersChain;

class SearchOnlineByChainException extends SearchOnlineBySearchersChain
{

    protected function initSearchRequest(string $searchGroupHash, string $alias, bool $isFromCache = false): ISearchRequestEntity
    {
        throw new \Exception('test exception');
    }

}
