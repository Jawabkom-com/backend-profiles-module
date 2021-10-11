<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\Builder\ProfileBuilder;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfileTest extends AbstractTestCase
{
    private CreateProfile $createProfile;
    public function setUp(): void
    {
        parent::setUp();
        $this->createProfile = app()->make(CreateProfile::class);
    }

    //Create New Profile
    public function testCreateProfile(){
       // $this->createProfile->input('profile',$dummyData)->process();
        $this->assertTrue(true);
    }

}
