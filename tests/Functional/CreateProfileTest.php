<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Carbon\Carbon;
use Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;

class CreateProfileTest extends AbstractTestCase
{
    use DummyTrait;
    private CreateProfile $createProfile;
    private \Faker\Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
       $this->createProfile = $di->make(CreateProfile::class);
       $this->faker = Factory::create();
    }

    //Create New Profile
    public function testCreateBasicProfile(){
        $userData = $this->dummyBasicProfileData();
        $profile = $this->createProfile->input('profile',$userData)
                                       ->process()
                                       ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
    }

    public function testProfileWithPhones(){
        $userData = $this->dummyBasicProfileData();
        $userData['phones'] = $this->dummyPhoneData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);


    }
}
