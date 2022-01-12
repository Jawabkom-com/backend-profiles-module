<?php

namespace Jawabkom\Backend\Module\Profile\Facade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeMergeEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeMergeRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositeScoring;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ISearchableText;
use Jawabkom\Backend\Module\Profile\Contract\Similarity\ISimilarityCompositeScore;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\SearchFilter\CountryCodeFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\EmailFilter;
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

    public function searchByEmail(string $email, array $filters = [], array $alias = [], array $meta = [], bool $sortByScore = true): array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByEmail::class);

        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('email', $email)
            ->input('filters', $filters)
            ->input('requestMeta', $meta)
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
                ->input('requestMeta', $meta)
                ->process()
                ->output('result');
        }
        $mergedComposites = $composites ? $this->mergeCompositesBySimilarity($composites) : [];

        //
        // order by composites score descending
        //
        if ($sortByScore)
            $this->sortCompositesByScores($mergedComposites);
        return $mergedComposites;
    }


    public function searchByPhone(string $phone, array $possibleCountries = [], array $filters = [], array $alias = [], array $meta = [], bool $sortByScore = true): array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByPhone::class);
        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('phone', $phone)
            ->input('possible_countries', $possibleCountries)
            ->input('filters', $filters)
            ->input('requestMeta', $meta)
            ->process()
            ->output('result');
        //
        // if no results then search online
        //
        if (empty($composites) && !empty($alias)) {
            $phoneLib = $this->di->make(Phone::class);
            $parsed = $phoneLib->parse($phone, $possibleCountries);
            if ($parsed['is_valid']) {
                $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
                $composites = $onlineSearchService
                    ->input('filters', ['phone' => $parsed['phone']])
                    ->input('searchersAliases', $alias)
                    ->input('requestMeta', $meta)
                    ->process()
                    ->output('result');
            }

        }
        $mergedComposites = $composites ? $this->mergeCompositesBySimilarity($composites) : [];

        //
        // order by composites score descending
        //
        if ($sortByScore)
            $this->sortCompositesByScores($mergedComposites);
        return $mergedComposites;
    }

    public function searchByName(string $name, array $filters = [], array $alias = [], array $meta = [], bool $sortByScore = true): array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByName::class);
        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('name', $name)
            ->input('filters', $filters)
            ->input('requestMeta', $meta)
            ->process()
            ->output('result');
        //
        // if no results then search online
        //
        if (empty($composites) && !empty($alias)) {
            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
            $composites = $onlineSearchService
                ->input('filters', ['raw_name' => $name])
                ->input('searchersAliases', $alias)
                ->input('requestMeta', $meta)
                ->process()
                ->output('result');
        }
        $mergedComposites = $composites ? $this->mergeCompositesBySimilarity($composites) : [];

        //
        // order by composites score descending
        //
        if ($sortByScore)
            $this->sortCompositesByScores($mergedComposites);
        return $mergedComposites;
    }

    public function searchByUsername(string $username, array $filters = [], array $alias = [], array $meta = [], bool $sortByScore = true): array
    {
        //
        // search offline first
        //
        $offlineService = $this->di->make(SearchOfflineByUserName::class);
        /**@var IProfileComposite[] $composites */
        $composites = $offlineService->input('username', $username)
            ->input('filters', $filters)
            ->input('requestMeta', $meta)
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
                ->input('requestMeta', $meta)
                ->process()
                ->output('result');
        }
        $mergedComposites = $composites ? $this->mergeCompositesBySimilarity($composites) : [];

        //
        // order by composites score descending
        //
        if ($sortByScore)
            $this->sortCompositesByScores($mergedComposites);
        return $mergedComposites;
    }

    public function advancedSearch(
        ?string $firstName = null,
        ?string $middleName = null,
        ?string $lastName = null,
        ?string $phone = null,
        ?string $email = null,
        ?string $username = null,
        ?string $countryCode = null,
        ?string $state = null,
        ?string $city = null,
        array   $alias = [],
        array   $meta = [],
        bool    $sortByScore = true): array
    {
        if (empty($email) && empty($phone) && empty($username) && empty($firstName) && empty($middleName) && empty($lastName)) {
            throw new MissingRequiredInputException('Missing required Argument,must provide at least one of these fields (first name,middle name,last name ,phone,email,username)');
        }

        $phoneLib = $this->di->make(Phone::class);
        $filters = [];
        if ($email) $filters[] = new EmailFilter($email);
        if ($username) $filters[] = new UserNameFilter($username);
        if($countryCode) {
            $filters[] = new CountryCodeFilter($countryCode);
            if($phone) {
                $possibleCountries = [];
                $possibleCountries[] = $countryCode;
                $phone = $phoneLib->parse($phone, $possibleCountries)['phone'];
            }
        } elseif ($phone) {
            $phone = $phoneLib->parse($phone, [])['phone'];
            $filters[] = new PhoneNumberFilter($phone);
        }
        $searchableName = null;
        if ($firstName || $middleName || $lastName) {
            $searchableText = $this->di->make(ISearchableText::class);
            $searchableName = $searchableText->prepare("{$firstName} {$middleName} {$lastName}");
            $filters[] = new NameFilter( $searchableName );
        }

        if ($email) {
            return $this->searchByEmail(email: $email, filters: $filters, alias: $alias, meta: $meta, sortByScore: $sortByScore);
        } elseif ($phone) {
            return $this->searchByPhone(phone: $phone, filters: $filters, alias: $alias, meta: $meta, sortByScore: $sortByScore, possibleCountries: ($possibleCountries??[]) );
        } elseif ($username) {
            return $this->searchByUsername(username: $username, filters: $filters, alias: $alias, meta: $meta, sortByScore: $sortByScore);
        } elseif ($searchableName ) {
            return $this->searchByName(name: $searchableName, filters: $filters, alias: $alias, meta: $meta, sortByScore: $sortByScore);
        }
        return [];

        //
        // if no results then search online
        //
//        if (empty($composites) && !empty($alias)) {
//            $filters = [];
//            if ($firstName) $filters['first_name'] = $firstName;
//            if ($middleName) $filters['middle_name'] = $middleName;
//            if ($phone) $filters['phone'] = $phone;
//            if ($email) $filters['email'] = $email;
//            if ($countryCode) $filters['country_code'] = $countryCode;
//            if ($city) $filters['city'] = $city;
//            if ($state) $filters['state'] = $state;
//            if ($username) $filters['username'] = $username;
//            $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class);
//            $composites = $onlineSearchService
//                ->input('filters', $filters)
//                ->input('searchersAliases', $alias)
//                ->input('requestMeta', $meta)
//                ->process()
//                ->output('result');
//
//        }
//        $mergedComposites = $composites ? $this->mergeCompositesBySimilarity($composites) : [];
//
//        //
//        // order by composites score descending
//        //
//        if ($sortByScore)
//            $this->sortCompositesByScores($mergedComposites);
//        return $mergedComposites;
    }


    /**
     * @param IProfileComposite[] $composites
     */
    protected function groupCompositesBySimilarity(array $composites): array
    {
        $similarityChecker = $this->di->make(ISimilarityCompositeScore::class);
        $compositesMergeService = $this->di->make(ICompositesMerge::class);
        $groups = [];

        $leaderInx = 0;
        while (count($composites)) {
            if (array_key_exists($leaderInx, $composites)) {
                $leaderComposite = $composites[$leaderInx];
                $groups[$leaderComposite->getProfile()->getProfileId()][] = $composites[$leaderInx];
                unset($composites[$leaderInx]);

                foreach ($composites as $inx => $composite) {
                    if ($similarityChecker->calculate($leaderComposite, $composite) >= 50) {
                        $groups[$leaderComposite->getProfile()->getProfileId()][] = $composite;
                        unset($composites[$inx]);
                    }
                }
            }
            $leaderInx++;
        }

        //
        // save merged composites
        //
        $mergeRepository = $this->di->make(IProfileCompositeMergeRepository::class);
        $uuidGenerator = $this->di->make(IProfileUuidFactory::class);
        $mergedGroups = [];
        foreach ($groups as $group) {
            if (count($group) > 1) {
                $mergeEntity = $this->di->make(IProfileCompositeMergeEntity::class);
                $mergeEntity->setMergeId('merge_' . $uuidGenerator->generate());
                foreach ($group as $composite) {
                    $mergeEntity->addProfileId($composite->getProfile()->getProfileId());
                }
                $mergedComposite = $compositesMergeService->merge($group);
                $mergedComposite->getProfile()->setProfileId($mergeEntity->getMergeId());
                $mergedGroups[] = $mergedComposite;
                $mergeRepository->saveEntity($mergeEntity);
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
            $leftScore = $compositeScore->score($left);
            $rightScore = $compositeScore->score($right);
            if ($leftScore == $rightScore) return 0;
            return ($leftScore < $rightScore) ? 1 : -1;
        });
    }

    /**
     * @param array $composites
     * @return array
     */
    protected function mergeCompositesBySimilarity(array $composites): array
    {
        // group composites by similarities
        //
        $compositesGroups = $this->groupCompositesBySimilarity($composites);
        return $compositesGroups;
    }

}