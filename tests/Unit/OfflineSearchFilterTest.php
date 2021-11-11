<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Facade\ProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\SearchFilter\CountryCodeFilter;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithException;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Standard\Contract\IDependencyInjector;

class OfflineSearchFilterTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private IDependencyInjector $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->faker = Factory::create();
    }

    public function testCountryCodeFilterWithMissing()
    {
        $filter           = new CountryCodeFilter('XR');
        $profileComposite = $this->di->make(IProfileComposite::class);
        $this->assertFalse($filter->apply($profileComposite));
    }

}
