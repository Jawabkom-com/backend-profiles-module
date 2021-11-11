<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Facade\ProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\SearchFilter\CountryCodeFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\EmailFilter;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithException;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Backend\Module\Profile\Validator\SearchFiltersInputValidator;
use Jawabkom\Standard\Contract\IDependencyInjector;

class SearchFiltersInputValidatorTest extends AbstractTestCase
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

    public function testSearchFiltersInputValidatorWIthNotExistsKey()
    {
        $this->expectException(InvalidInputStructure::class);
        $v = new SearchFiltersInputValidator();
        $v->validate(['xx']);
    }
    public function testSearchFiltersInputValidatorWIthInvalidEmail()
    {
        $this->expectException(InvalidEmailAddressFormat::class);
        $v = new SearchFiltersInputValidator();

        $v->validate(['email'=>new EmailFilter('test@test')]);
    }

}
