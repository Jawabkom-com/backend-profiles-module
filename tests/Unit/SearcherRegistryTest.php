<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Exception\FilterLogicalOperationDoesNotExists;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithException;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IOrFilterComposite;

class SearcherRegistryTest extends AbstractTestCase
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

    public function testGetSearcherRegistry()
    {
        /**@var $searcherRegistry SearcherRegistry */
        $searcherRegistry = $this->di->make(SearcherRegistry::class);
        $mapper = new TestSearcherMapper();
        $searcherRegistry->register('searcher1', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithMultiResults(), $mapper);
        $getRegistrySearcherInstance = $searcherRegistry->getRegistry('searcher1')['searcher'];
        $this->assertInstanceOf(TestSearcherWithException::class,$getRegistrySearcherInstance);
    }

    public function testGetAllRegistries()
    {
        /**@var $searcherRegistry SearcherRegistry */
        $searcherRegistry = $this->di->make(SearcherRegistry::class);
        $mapper = new TestSearcherMapper();
        $searcherRegistry->register('searcher1', new TestSearcherWithException(), $mapper);
        $searcherRegistry->register('searcher2', new TestSearcherWithMultiResults(), $mapper);
        $getAllRegistries = $searcherRegistry->getRegistries();
        $this->assertCount(2,$getAllRegistries);
    }


}
