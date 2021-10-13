<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Service\SearchOnlineBySearchersChain;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithOneResult;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;
use JetBrains\PhpStorm\Pure;

class SearchOnlineTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private SearchOfflineByFilters $searchOfflineByFilters;
    private \Faker\Generator $faker;
    private IDependencyInjector $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchOfflineByFilters = $this->di->make(SearchOfflineByFilters::class);
        $this->faker = Factory::create();
    }

    public function testSingleSearcherWithOneResult()
    {
        $searcher = new TestSearcherWithOneResult();
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('pipl', $searcher, $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain*/
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $profiles = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahmad'])
            ->input('searchersAliases', ['searcher1'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process()
            ->output('profiles');
        $this->assertEquals(1, count($profiles));
        $this->assertInstanceOf(IProfileEntity::class, $profiles[0]);
    }

    public function testSingleSearcherWithMultiResult() {

    }

    public function testMultiSearchersWithResults_One_Multi_Zero() {

    }

    public function testMultiSearchersWithResults_Zero_Exception_One() {

    }

    public function testMultiSearchersWithResults_Zero_Exception_Zero() {

    }

    public function testMultiSearchersWithResults_Zero_Zero_Multi() {

    }




}
