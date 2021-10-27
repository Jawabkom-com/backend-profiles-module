<?php

namespace Functional;

use Faker\Factory;
use Illuminate\Support\Str;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Exception\EntityNotExists;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Service\ReplaceProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class ReplaceProfileTest extends AbstractTestCase
{
    use DummyTrait;
    /**
     * @var CreateProfile|mixed
     */
    private mixed $createProfile;
    private \Faker\Generator $faker;
    private DI $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->faker = Factory::create();

    }

    public function testReplaceProfileWithNewProfileByProfileId(){
        //create dummy profile data
        $dummyProfilesData = $this->generateBulkDummyData();
        //create first profile using dummy data and return profileComposite
        $profileComposite = $this->createProfile->input('profile',$dummyProfilesData[0])
                                                ->process()
                                                ->output('result');
        //verify result of create service is a composite type
        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);
        //get profile_id of profile  was created
        $profileId = $profileComposite->getProfile()->getProfileId();
        //verify profile_id value
        $this->assertIsString($profileId);
        //verify profile id in DB
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profileId
        ]);
        // check if profile id in db related entity tables like name
        $this->assertDatabaseHas('profile_names',[
            'profile_id' => $profileId
        ]);
        //di replaceProfile service class
        $replaceService = $this->di->make(ReplaceProfile::class);
        //replace profile with another profile using profile_id
        $newProfile = $replaceService->inputs(['profile_id'=>$profileId,'profile'=>$dummyProfilesData[1]])
                                     ->process()
                                     ->output('profile');
        $this->assertInstanceOf(IProfileComposite::class,$newProfile);
        //check if profile_id is the same profile_id with new profile Composite
        $this->assertEquals($profileId,$newProfile->getProfile()->getProfileId());
        //verify profile id in DB
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profileId
        ]);
        // check if profile id in db related entity tables like name
        $this->assertDatabaseHas('profile_names',[
            'profile_id' => $profileId
        ]);
    }

    public function testReplaceProfileWithMissingProfileId(){
        //create dummy profile data
        $dummyProfilesData = $this->generateBulkDummyData();
        $replaceService = $this->di->make(ReplaceProfile::class);
        $this->expectException(MissingRequiredInputException::class);
        $newProfile = $replaceService->inputs(['profile_id'=>'','profile'=>$dummyProfilesData[1]])
                                    ->process()
                                    ->output('profile');
    }

    public function testReplaceProfileWithProfileIdNotExists(){
        //create dummy profile data
        $dummyProfilesData = $this->generateBulkDummyData();
        $replaceService = $this->di->make(ReplaceProfile::class);
        $this->expectException(EntityNotExists::class);
        $newProfile = $replaceService->inputs(['profile_id'=>'75e19f18-320a-4918-99c0-1b7bb075ad21','profile'=>$dummyProfilesData[1]])
                                    ->process()
                                    ->output('profile');
    }
}