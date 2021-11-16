<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Facade\SearchFacade;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;

class SearchFacadeTest extends AbstractTestCase
{
    use DummyTrait;
    private DI $di;
    /**
     * @var SearchFacade|mixed
     */
    private mixed $searchFacade;
    private \Faker\Generator $faker;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->di = new DI();
        $this->faker = Factory::create();
        $this->searchFacade = $this->di->make(SearchFacade::class);
    }

    public function testSearchFacadeByEmailOffline(){
        $dummyProfilesData = $this->generateBulkDummyData(7);
        $email = $dummyProfilesData[0]['emails'][0]['email'];
        $dummyProfilesData[2]['emails'][0]['email'] = $email;
        $dummyProfilesData[5]['emails'][0]['email'] = $email;
        unset( $dummyProfilesData[5]['phones']);
        $this->createProfile($dummyProfilesData);

        $resultComposites = $this->searchFacade->searchByEmail($email);
        foreach ($resultComposites as $compositeScore){
           foreach ($compositeScore as $composite){
               $this->assertInstanceOf(IProfileComposite::class, $composite);
           }
        }

    }



    /**
     * @param array $dummyProfilesData
     * @return array
     */
    protected function createProfile(array $dummyProfilesData): array
    {
        $fakeProfiles = [];
        $createProfile = $this->di->make(CreateProfile::class);
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        return $fakeProfiles;
    }

}