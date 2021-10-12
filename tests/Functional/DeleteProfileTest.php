<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;


use Jawabkom\Backend\Module\Profile\Service\DeleteProfile;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;

class DeleteProfileTest extends AbstractTestCase
{
    use DummyTrait;
    private CreateProfile $createProfile;
    private DeleteProfile $deleteProfile;
    private \Faker\Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
        $this->createProfile = $di->make(CreateProfile::class);
        $this->deleteProfile = $di->make(DeleteProfile::class);
       $this->faker = Factory::create();
    }

    //Create New Profile
    public function testDeleteProfile(){

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

        $profileId = $profile->getProfileId();
        $deleteStatus =  $this->deleteProfile->input('profile_id',$profileId)->process()->output('status');
        $this->assertTrue($deleteStatus);
    }


    //ProfileId Not Exist
    public function testProfileIdNotExist(){
        $this->expectError();
        $profileId = $this->faker->randomDigit();
        $this->deleteProfile->input('profile_id',$profileId)->process()->output('status');
    }

}
