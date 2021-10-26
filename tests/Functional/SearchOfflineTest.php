<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineTest extends AbstractTestCase
{
    use DummyTrait;
    private CreateProfile $createProfile;
    private SearchOfflineByFilters $searchOfflineByFilters;
    private \Faker\Generator $faker;
    private DI $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchOfflineByFilters = $this->di->make(SearchOfflineByFilters::class);
        $this->faker = Factory::create();
    }

    //Create New Profile
    public function testGetProfileWithFilter(){
        $dummyProfilesData = $this->generateBulkDummyData();
        $fakeProfiles   = [];
        foreach ($dummyProfilesData as $profileDummyData){
          $fakeProfiles[] =  $this->createProfile->input('profile',$profileDummyData)
                                               ->process()
                                               ->output('profile');
        }
        $filter =[
            'email'       => $dummyProfilesData[1]['emails'][0]['email'],
            'first_name'  => $dummyProfilesData[1]['names'][0]['first'],
            'middle_name' => $dummyProfilesData[1]['names'][0]['middle'],
            'last_name'   => $dummyProfilesData[1]['names'][0]['last'],
            'phone'       => $dummyProfilesData[1]['phones'][0]['formatted_number'],
            'country_code'=> $dummyProfilesData[1]['phones'][0]['country_code'],
            'city'        => $dummyProfilesData[1]['addresses'][0]['city'],
            'state'       => $dummyProfilesData[1]['addresses'][0]['state'],
            'username'    => $dummyProfilesData[1]['usernames'][0]['username'],
        ];
        $profileCompositesResults = $this->searchOfflineByFilters->input('filters',$filter)->process()->output('result');
       $this->assertInstanceOf(IProfileComposite::class,$profileCompositesResults[0]);
       $this->assertInstanceOf(IProfileEntity::class,$profileCompositesResults[0]->getProfile());
    }

    public function testMissingFilter(){
        $filter=[];
        $this->expectException(MissingRequiredInputException::class);
        $result = $this->searchOfflineByFilters->input('filters',$filter)->process()->output('result');
    }
}
