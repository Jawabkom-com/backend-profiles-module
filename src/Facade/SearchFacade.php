<?php

namespace Jawabkom\Backend\Module\Profile\Facade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Backend\Module\Profile\Contract\similarity\ISimilarityCompositeScore;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByEmail;
use Jawabkom\Backend\Module\Profile\Service\SearchOnlineBySearchersChain;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchFacade
{
    private IDependencyInjector $di;

    public function __construct(IDependencyInjector $dependencyInjector)
    {
        $this->di = $dependencyInjector;

    }

    public function searchByEmail(string $email, array $alias=[],array $meta=[]):iterable
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByEmail::class);

        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('email', $email)
                                     ->process()
                                     ->output('result');

        //
        // if no results then search online
        //
        if (empty($composites) && !empty($alias)) {
            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
            $composites = $onlineSearchService
                ->input('filters', ['email' => $email])
                ->input('searchersAliases', $alias)
                ->input('requestMeta',$meta)
                ->process()
                ->output('result');
        }
        //
        // group composites by similarities
        //
        $compositesGroups = $this->groupCompositesBySimilarity($composites);
        //
        // order by composites score descending
        //
        $this->sortCompositesByScores($compositesGroups);
        return $compositesGroups;
    }


    public function searchByPhone(string $phone, array $alias =[]):array
    {
        return [];
    }

    public function searchByName(string $name, array $alias =[]):array
    {
        return [];
    }

    public function searchByUsername(string $username, array $alias =[]):array
    {
        return [];
    }

    public function advancedSearch(
        ?string $firstName = null,
        ?string $middleName = null,
        ?string $lastName = null,
        ?string $phone = null,
        ?string $email = null,
        ?string $username = null,
        ?string $countryCode  = null,
        ?string $state = null,
        ?string $city = null,
        array $alias =[]):array
    {
        return [];
    }


    /**
     * @param IProfileComposite[] $composites
     */
    protected function groupCompositesBySimilarity(array $composites): array
    {
        $similarityChecker      = $this->di->make(ISimilarityCompositeScore::class);
        $compositesMergeService = $this->di->make(ICompositesMerge::class);
        $groups = [];
        $count = count($composites) ;
        for ($i=0;$i<$count;$i++) {
          for ($j=$i+1;$j<$count;$j++){
              //a +b ==?50
              //c +d ==50
              $score =  $similarityChecker->calculate($composites[$i],$composites[$j]);
                if ($score > 50){
                    $composite = $compositesMergeService->merge($composites[$i],$composites[$j]);
                }
              $groups[$score][]=$composite;
          }
        }
        return $groups;
    }

    /**
     * @param IProfileComposite[] $composites
     */
    protected function sortCompositesByScores(array &$composites)
    {
        krsort($composites);
    }

}