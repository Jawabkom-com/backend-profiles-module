<?php

namespace Jawabkom\Backend\Module\Profile\Facade;

use Jawabkom\Backend\Module\Profile\Contract\Facade\ISearchByEmailFacade;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByEmail;
use Jawabkom\Backend\Module\Profile\Service\SearchOnlineBySearchersChain;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchByEmailFacade implements ISearchByEmailFacade
{
    private IDependencyInjector $di;
    private mixed $offlineService;

    public function __construct(IDependencyInjector $dependencyInjector)
    {
        $this->di = $dependencyInjector;
        $this->offlineService = $this->di->make(SearchOfflineByEmail::class);
    }

    public function searchByEmail(string $email,$advanceFilter=[],array $alias=[],SearcherRegistry $searcherRegistry = null):iterable
    {
        $toReturn = $this->offlineService->input('email', $email)->input('filters', $advanceFilter)
                                                                 ->process()
                                                                 ->output('result');

     if (empty($toReturn) && !(empty($searcherRegistry) && empty($alias))){
         $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
         $toReturn = $onlineSearchService
             ->input('filters', ['email' => $email])
             ->input('searchersAliases', $alias)
             ->process()->output('result');
     }
        return $toReturn;
    }
}