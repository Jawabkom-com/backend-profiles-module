<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Facade\ProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithException;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ProfileCompositeFacadeTest extends AbstractTestCase
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

    public function testProfileCompositeFacadeWithNotExistsProfileId()
    {
       $profileId = sha1('test text to generate random profileId');
       $facde =$this->di->make(IProfileCompositeFacade::class);
       $profileComposite =  $facde->getCompositeByProfileId($profileId);
       $this->assertNull($profileComposite);
    }

}
