<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Carbon\Carbon;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;

class CreateProfileTest extends AbstractTestCase
{
    private CreateProfile $createProfile;
    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
       $this->createProfile = $di->make(CreateProfile::class);
    }

    //Create New Profile
    public function testCreateProfile(){
        $userData =[
            'gender'=>'male',
            'date_of_birth'=>Carbon::now()->subYears(20),
            'place_of_birth'=>'palestine',
            'data_source'=>'facebook',
        ];
        $profile = $this->createProfile->input('profile',$userData)
                                       ->process()
                                       ->output('profile');
        $this->assertNotEmpty($profile);
        //$this->assertInstanceOf(IProfileRepository::class,$profile);
    //   $this->assertInstanceOf(IProfileEntity::class,$profile);
    }

}
