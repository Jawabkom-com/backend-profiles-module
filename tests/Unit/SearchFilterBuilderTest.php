<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Exception\FilterLogicalOperationDoesNotExists;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IOrFilterComposite;

class SearchFilterBuilderTest extends AbstractTestCase
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

    public function testFilterWithLogicalOperationMissing()
    {
        $this->expectException(FilterLogicalOperationDoesNotExists::class);
        /**@var $searchFilterBuilder SimpleSearchFiltersBuilder */
        $searchFilterBuilder = $this->di->make(SimpleSearchFiltersBuilder::class);
        $searchFilterBuilder
            ->setAllFilters(['first_name' => 'Ahma111111'])
            ->registerFilter('new')
            ->setFilterType($this->faker->word)->build();
    }

    public function testInstantiateOrFilterCompositeObject()
    {
        /**@var $searchFilterBuilder SimpleSearchFiltersBuilder */
        $searchFilterBuilder = $this->di->make(SimpleSearchFiltersBuilder::class);
        $searchFilterBuilder = $searchFilterBuilder
            ->setAllFilters(['first_name' => 'Ahma111111'])
            ->registerFilter('new')
            ->setFilterType('or')->build();
        $this->assertInstanceOf(IOrFilterComposite::class,$searchFilterBuilder);
    }

}
