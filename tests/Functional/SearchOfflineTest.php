<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;


use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;

class SearchOfflineTest extends AbstractTestCase
{
    use DummyTrait;
    private CreateProfile $createProfile;
    private SearchOfflineByFilters $searchOfflineByFilters;
    private \Faker\Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
        $this->createProfile = $di->make(CreateProfile::class);
        $this->searchOfflineByFilters = $di->make(SearchOfflineByFilters::class);
       $this->faker = Factory::create();
    }

    //Create New Profile
    public function testFilterByEmail(){
        $dummyData = $this->generateDummyData();
        $filter =[
            'email' =>$dummyData[0]['emails'][0]['email']
        ];
        $this->searchOfflineByFilters->input('filters',$filter)->process();

    }


    private function generateDummyData()
    {
        $dummyData  = [];
        for ($i = 0; $i < 1; $i++) {
            $userData = $this->dummyBasicProfileData();
            $userData['emails'][] = $this->dummyEmailsData();
            $this->createProfile->input('profile',$userData)
                ->process()
                ->output('profile');

            $dummyData[] =  $userData;
        }
        return $dummyData;
    }

}
