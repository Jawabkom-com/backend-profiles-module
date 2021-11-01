<?php

namespace Jawabkom\Backend\Module\Profile\Test\Integration;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEntityMapper;
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
        //$this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchOfflineByFilters = $this->di->make(SearchOfflineByFilters::class);
        $this->faker = Factory::create();
    }

    public function testProfileEntity2Array2ProfileEntityMapping()
    {
        $originEntity = $this->di->make(IProfileEntity::class);
        $originEntity->setDataSource('test_data_source');
        $originEntity->setPlaceOfBirth('JO');
        $originEntity->setDateOfBirth('2021-10-01');
        $originEntity->setGender('male');

        $toArrayMapper = $this->di->make(IProfileEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);

        $toProfileEntityMapper = $this->di->make(IArrayToProfileEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);

        $this->assertEquals(serialize($originEntity), serialize($newEntity));
    }

    public function testInputArrayMustMatchTheArrayAfterMapping()
    {
        //TODO: map array to a profilecomposite then map it back to array and make suer that the input is identical with the mapped array
    }


}
