<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Exception\InvalidFilterException;
use Jawabkom\Backend\Module\Profile\Facade\SearchFacade;
use Jawabkom\Backend\Module\Profile\SearchFilter\UserNameFilter;
use Jawabkom\Backend\Module\Profile\Service\GetProfileById;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByEmail;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByPhone;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByUserName;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Profile\ProfilePhone;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class GetProfileByIdTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private DI $di;
    /**
     * @var SearchOfflineByEmail|mixed
     */
    private mixed $searchByEmailService;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchByEmailService = $this->di->make(SearchOfflineByEmail::class);
        $this->faker = Factory::create();
    }

    //testGetProfileById
    public function testGetProfileByIdWithSimilarity()
    {
        $dummyProfilesData = $this->generateBulkDummyData(10);
        //make 4 dummy data with 100% Similarity
        $email = $dummyProfilesData[1]['emails'][0]['email'];
        $dummyProfilesData[0]['emails'][0]['email'] = $email;
        $dummyProfilesData[3]['emails'][0]['email'] = $email;
        $dummyProfilesData[5]['emails'][0]['email'] = $email;
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $searchFacade = $this->di->make(SearchFacade::class);
        $profileCompositesResultSearch = $searchFacade->searchByEmail(email:$email);
        $composerToArray = $this->di->make(IProfileCompositeToArrayMapper::class);
        $results = [];
        foreach ($profileCompositesResultSearch as $composite){
            $results[] = $composerToArray->map($composite,true);
        }
        //should be 1 merged result
      $this->assertEquals(1,count($results));
        //should have merge prefix
        $mergedProfileId =$results[0]['profile_id'];
      $this->assertStringContainsString('merge_',$mergedProfileId);
      //verify  store in db
      $this->assertDatabaseHas('profile_composite_merges',[
          'merge_id'=>$mergedProfileId
      ]);
      $getByMergeService = $this->di->make(GetProfileById::class);
        $mergedCompositesResultSearch =  $getByMergeService->input('profile_id',$mergedProfileId)->process()->output('profile');
        $mergedResults = $composerToArray->map($mergedCompositesResultSearch,true);
        $this->assertNotEmpty($mergedResults);
        $this->assertStringNotContainsString('merge_',$mergedResults['profile_id']);
    }  //testGetProfileById
    public function testGetProfileByIdWithoutSimilarity()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        //make 4 dummy data with 100% Similarity
        $email = $dummyProfilesData[0]['emails'][0]['email'];
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $searchFacade = $this->di->make(SearchFacade::class);
        $profileCompositesResultSearch = $searchFacade->searchByEmail(email:$email);
        $composerToArray = $this->di->make(IProfileCompositeToArrayMapper::class);
        $results = [];
        foreach ($profileCompositesResultSearch as $composite){
            $results[] = $composerToArray->map($composite,true);
        }
        //should be 1 merged result
      $this->assertEquals(1,count($results));
        //should have merge prefix
        $mergedProfileId =$results[0]['profile_id'];
      $this->assertStringContainsString('merge_',$mergedProfileId);
      //verify  store in db
      $this->assertDatabaseHas('profile_composite_merges',[
          'merge_id'=>$mergedProfileId
      ]);
      $getByMergeService = $this->di->make(GetProfileById::class);
        $mergedCompositesResultSearch =  $getByMergeService->input('profile_id',$mergedProfileId)->process()->output('profile');
        $mergedResults = $composerToArray->map($mergedCompositesResultSearch,true);
        $this->assertNotEmpty($mergedResults);
        $this->assertStringNotContainsString('merge_',$mergedResults['profile_id']);
        $singleCompositesResultSearch =  $getByMergeService->input('profile_id',$mergedResults['profile_id'])->process()->output('profile');
        $this->assertNotEmpty($singleCompositesResultSearch);

    }
}
