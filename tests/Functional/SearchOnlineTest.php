<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Illuminate\Support\Carbon;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Exception\FilterNameDoesNotExistsException;
use Jawabkom\Backend\Module\Profile\Exception\SearcherRegistryDoesNotExist;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Service\SearchOnlineBySearchersChain;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithException;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithHourlyLimit;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithOneResult;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithZeroResults;
use Jawabkom\Backend\Module\Profile\Test\Classes\SearchOnlineByChainException;
use Jawabkom\Standard\Contract\IDependencyInjector;

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
        $searcherRegistry->register('searcher1', $searcher, $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahmad'])
            ->input('searchersAliases', ['searcher1'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $profiles = $outputs->output('profiles');
        $this->assertEquals(1, count($profiles));
        $this->assertInstanceOf(IProfileEntity::class, $profiles[0]);
        $this->assertInstanceOf(IProfileRepository::class, $profiles[0]);
        $this->assertDatabaseHas('profiles', [
            'profile_id' => $profiles[0]->getProfileId()
        ]);
    }

    public function testSingleSearcherWithMultiResult()
    {
        $searcher = new TestSearcherWithMultiResults();
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', $searcher, $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahmad'])
            ->input('searchersAliases', ['searcher1'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $profiles = $outputs->output('profiles');
        $this->assertEquals(3, count($profiles));
        $this->assertInstanceOf(IProfileEntity::class, $profiles[1]);
        $this->assertInstanceOf(IProfileRepository::class, $profiles[1]);
        $this->assertDatabaseHas('profiles', [
            'profile_id' => $profiles[1]->getProfileId()
        ]);

    }

    public function testMultiSearchersWithResults_One_Multi_Zero()
    {
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithOneResult(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithMultiResults(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithZeroResults(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahmad'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $profiles = $outputs->output('profiles');
        $this->assertEquals('searcher1', $profiles[0]['data_source']);
        $this->assertCount(1, $profiles);
        $this->assertCount(1, $outputs->output('search_requests'));
    }

    public function testMultiSearchersWithResults_Zero_Exception_One()
    {
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithZeroResults(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithOneResult(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $profiles = $outputs->output('profiles');
        $this->assertEquals('searcher3', $profiles[0]['data_source']);
        $this->assertCount(1, $profiles);
        $this->assertCount(3, $outputs->output('search_requests'));

    }

    public function testMultiSearchersWithResults_Zero_Exception_Zero()
    {
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithZeroResults(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithZeroResults(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $profiles = $outputs->output('profiles');
        $this->assertNull($profiles);
        $this->assertCount(3, $outputs->output('search_requests'));
    }

    public function testMultiSearchersWithResults_Zero_Zero_Multi()
    {
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithZeroResults(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithZeroResults(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithMultiResults(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $profiles = $outputs->output('profiles');
        $this->assertEquals('searcher3', $profiles[0]['data_source']);
        $this->assertCount(3, $profiles);
        $this->assertCount(3, $outputs->output('search_requests'));
    }

    public function testCheckSearchResultCached()
    {
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithZeroResults(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithZeroResults(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithMultiResults(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $this->assertTrue($outputs->output('search_requests')[0]['is_from_cache']);
    }

    public function testAliasMissing()
    {
        $this->expectException(SearcherRegistryDoesNotExist::class);
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithException(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher4', 'searcher5', 'searcher6'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
    }

    public function testFilterMissing()
    {
        $this->expectException(FilterNameDoesNotExistsException::class);
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithException(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $onlineSearchService
            ->input('filters', [$this->faker->word => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', 'ed')
            ->process();
    }

    public function testFilterEmpty()
    {
        $this->expectException("Exception");
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithException(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry]);
        $onlineSearchService
            ->input('filters', [])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', 'ed')
            ->process();
    }

    public function testSearchWithInitRequestException()
    {
        $this->expectExceptionMessage("test exception");
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher3', new TestSearcherWithException(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineByChainException::class, ['registry' => $searcherRegistry]);
        $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111111'])
            ->input('searchersAliases', ['searcher1', 'searcher2', 'searcher3'])
            ->input('requestMeta', 'ed')
            ->process();
    }


    public function testDailySearchLimit()
    {
        $mapper = new TestSearcherMapper();
        $searcherRegistry = new SearcherRegistry();
        $searcherRegistry->register('searcher1', new TestSearcherWithHourlyLimit(), $mapper);
        /**@var $onlineSearchService SearchOnlineBySearchersChain */
        $onlineSearchService = $this->di->make(SearchOnlineBySearchersChain::class, ['registry' => $searcherRegistry , 'currentDateTime' => Carbon::now()]);

        $onlineSearchService
            ->input('filters', ['first_name' => 'Ahmededa111111dd'])
            ->input('searchersAliases', ['searcher1'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111ede111jk'])
            ->input('searchersAliases', ['searcher1'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
        $outputs = $onlineSearchService
            ->input('filters', ['first_name' => 'Ahma111ede111'])
            ->input('searchersAliases', ['searcher1'])
            ->input('requestMeta', ['searcher_user_id' => 10, 'tracking_uuid' => 'test-uuid'])
            ->process();
      //  dd(count($outputs->output('search_requests')));
        $this->assertTrue(true);
    }


}
