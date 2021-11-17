<?php

namespace Jawabkom\Backend\Module\Profile\Facade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositeScoring;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Backend\Module\Profile\Contract\similarity\ISimilarityCompositeScore;
use Jawabkom\Backend\Module\Profile\SearchFilter\NameFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\PhoneNumberFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\UserNameFilter;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByEmail;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByName;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByPhone;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByUserName;
use Jawabkom\Backend\Module\Profile\Service\SearchOnlineBySearchersChain;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchFacade
{
    private IDependencyInjector $di;

    public function __construct(IDependencyInjector $dependencyInjector)
    {
        $this->di = $dependencyInjector;

    }

    public function searchByEmail(string $email,array $filters=[],array $alias=[],array $meta=[]):array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByEmail::class);

        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('email', $email)
                                     ->input('filters', $filters)
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
        return $composites?$this->getComposites($composites):[];
    }


    public function searchByPhone(string $phone,array $possibleCountries =[],array $filters =[],array $alias =[],array $meta =[]):array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByPhone::class);
        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('phone', $phone)
                                     ->input('possible_countries',$possibleCountries)
                                     ->input('filters', $filters)
                                     ->process()
                                     ->output('result');
        //
        // if no results then search online
        //
        if (empty($composites) && !empty($alias)) {
            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
            $composites = $onlineSearchService
                ->input('filters', ['phone' => $phone])
                ->input('searchersAliases', $alias)
                ->input('requestMeta',$meta)
                ->process()
                ->output('result');
        }
        return $composites?$this->getComposites($composites):[];

    }

    public function searchByName(string $name,array $filters=[],array $alias=[],array $meta=[]):array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByName::class);
        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('name', $name)
                                     ->input('filters', $filters)
                                     ->process()
                                     ->output('result');
        //
        // if no results then search online
        //
        if (empty($composites) && !empty($alias)) {
            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
            $composites = $onlineSearchService
                ->input('filters', ['first_name' => $name])
                ->input('searchersAliases', $alias)
                ->input('requestMeta',$meta)
                ->process()
                ->output('result');
        }
        return $composites?$this->getComposites($composites):[];

    }

    public function searchByUsername(string $username,array $filters=[],array $alias=[],array $meta=[]):array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByUserName::class);
        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('username', $username)
                                     ->input('filters', $filters)
                                     ->process()
                                     ->output('result');
        //
        // if no results then search online
        //
        if (empty($composites) && !empty($alias)) {
            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
            $composites = $onlineSearchService
                ->input('filters', ['username' => $username])
                ->input('searchersAliases', $alias)
                ->input('requestMeta',$meta)
                ->process()
                ->output('result');
        }
        return $composites?$this->getComposites($composites):[];

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
        array $alias =[],
        array $meta=[]):array
    {

        if (empty($email) &&
            empty($phone) &&
            empty($username) &&
            empty($firstName)&&
            empty($middleName) &&
            empty($lastName)){
            throw new MissingRequiredInputException('Missing required Argument,must provide at least one of these fields (first name,middle name,last name ,phone,email,username)');
        }
        if ($email){
            $filters = [];
            if ($phone) $filters[] = new PhoneNumberFilter($phone);
            if ($username) $filters[] = new UserNameFilter($username);
            if ($firstName || $middleName || $lastName) $filters[] = new NameFilter("{$firstName}{$middleName}{$lastName}");
            $composites = $this->searchByEmail(email: $email,filters: $filters);
        }

        if ($phone && empty($composites)){
            $filters = [];
            if ($username) $filters[] = new UserNameFilter($username);
            if ($firstName || $middleName || $lastName) $filters[] = new NameFilter("{$firstName}{$middleName}{$lastName}");
            $composites = $this->searchByPhone(phone: $phone,filters: $filters);
        }

        if ($username && empty($composites)){
            $filters = [];
            if ($firstName || $middleName || $lastName) $filters[] = new NameFilter("{$firstName}{$middleName}{$lastName}");
            $composites = $this->searchByUsername(username: $username,filters: $filters);
        }

        if (($firstName || $middleName || $lastName) && empty($composites)){
           $composites =  $this->searchByName(name: "{$firstName}{$middleName}{$lastName}");
        }

        //
        // if no results then search online
        //

        if (empty($composites) && !empty($alias)) {
            $filters =[
                'first_name'=>$firstName,
                'last_name'=>$lastName,
                'middle_name'=>$middleName,
                'phone'=>$phone,
                'email'=>$email,
                'country_code'=>$countryCode,
                'city'=>$city,
                'state'=>$state,
                'username'=>$username
            ];

            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
            $composites = $onlineSearchService
                ->input('filters', $filters)
                ->input('searchersAliases', $alias)
                ->input('requestMeta',$meta)
                ->process()
                ->output('result');
            $composites = $composites?$this->getComposites($composites):[];
        }
        return empty($composites)?[]:$composites;
    }


    /**
     * @param IProfileComposite[] $composites
     */
    protected function groupCompositesBySimilarity(array $composites): array
    {
        $similarityChecker      = $this->di->make(ISimilarityCompositeScore::class);
        $compositesMergeService = $this->di->make(ICompositesMerge::class);
        $groups = [];

        $leaderInx = 0;
        while(count($composites)) {
            if(isset($composites[$leaderInx])) {
                $leaderComposite = $composites[$leaderInx];
                $groups[$leaderComposite->getProfile()->getProfileId()][] = $composites[$leaderInx];
                unset($composites[$leaderInx]);

                foreach($composites as $inx => $composite) {
                    if($similarityChecker->calculate($leaderComposite, $composite) >= 50) {
                        $groups[$leaderComposite->getProfile()->getProfileId()][] = $composite;
                        unset($composites[$inx]);
                    }
                }
            }
            $leaderInx++;
        }

        $mergedGroups = [];
        foreach($groups as $group) {
            if(count($group) > 1) {
                $mergedGroups[] = $compositesMergeService->merge($group);
            } else {
                $mergedGroups[] = $group[0];
            }
        }

        return $mergedGroups;
    }

    /**
     * @param IProfileComposite[] $composites
     */
    protected function sortCompositesByScores(array &$composites)
    {
        $compositeScore = $this->di->make(ICompositeScoring::class);
        usort($composites, function ($left, $right) use ($compositeScore) {
            $leftScore  = $compositeScore->score($left);
            $rightScore = $compositeScore->score($right);
            if ($leftScore==$rightScore) return 0;
            return ($leftScore<$rightScore);
        });
    }

    /**
     * @param array $composites
     * @return array
     */
    protected function getComposites(array $composites): array
    {
        // group composites by similarities
        //
        $compositesGroups = $this->groupCompositesBySimilarity($composites);
        //
        // order by composites score descending
        //
        $this->sortCompositesByScores($compositesGroups);
        return $compositesGroups;
    }

}