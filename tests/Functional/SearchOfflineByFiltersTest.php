<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\Builder\ProfileBuilder;

class SearchOfflineByFiltersTest extends AbstractTestCase
{
    private SearchOfflineByFilters $searchOfflineByFilters;

    public function setUp(): void
    {
        parent::setUp();
        $this->searchOfflineByFilters = app()->make(SearchOfflineByFilters::class);
    }

    //search result by name
    public function testSearchResultByName(){
        $databaseDirectory = __DIR__ . "/ProfileDB";
        $newsStore = new \SleekDB\Store("profiles", $databaseDirectory ,[
            "timeout" => false,
        ]);
//        $dummyData = $this->generateProfiles();
//        $results = $newsStore->insert($dummyData);


        $allNews = $newsStore->findAll();
        dd($allNews);

        $filter =[
                'raw_name'=>$dummyData[0]->Name[0]->first
        ];
        $result = $this->searchOfflineByFilters->input('filters',$filter)->process()->output('profiles');;
        dd($result);
        $this->assertTrue(true);
    }

    //search by filter
    public function testSearchResultByEmail(){}

    //search by filter
    public function testSearchResultByPhone(){}

    //search by filter
    public function testSearchResultByMultipleFilters(){}

    //filter not exist
    public function testFilterNotExist(){}

    //search by filter
    public function testSearchNotInstanceOfMapper(){}


    public function generateProfiles() :array
    {
        $array = [];
        for ($i = 0; $i < 2; $i++) {
            $profileBuilder = new ProfileBuilder();
            $array[] = $profileBuilder
                ->setProfileId()
                ->addFakeUserName()
//                ->addFakeUserName()
//                ->addFakeUserName()
                ->setGender()
//                ->addFakeAddress()
//                ->addFakeCriminalRecord()
//                ->addFakeCriminalRecord()
//                ->addFakeEducation()
//                ->addFakeEmail()
//                ->addFakeImage()
//                ->addFakeJob()
//                ->addFakeLanguage()
                ->addFakeName()
//                ->addFakePhone()
//                ->addFakeRelationship()
//                ->addFakeSkill()
//                ->addFakeSocialProfile()
//                ->setDateOfBirth()
//                ->setPlaceOfBirth()
                ->get();
        }
        return $array;
    }
}
