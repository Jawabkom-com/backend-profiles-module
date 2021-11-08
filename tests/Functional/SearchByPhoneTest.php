<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Illuminate\Queue\Failed\DynamoDbFailedJobProvider;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByPhone;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchByPhoneTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private DI $di;
    /**
     * @var SearchOfflineByPhone|mixed
     */
    private mixed $searchByPhoneService;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchByPhoneService = $this->di->make(SearchOfflineByPhone::class);
        $this->faker = Factory::create();
    }

    //testSearchOfflineByPhone
    public function testSearchOfflineByPhone()
    {
        $dummyProfilesData = $this->generateBulkDummyData();
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $phone = $dummyProfilesData[1]['phones'][0]['original_number'];
        $countryCode = $dummyProfilesData[1]['phones'][0]['country_code'];
        $filter = [
            'country_code' => $countryCode
        ];
        $profileCompositesResults = $this->searchByPhoneService->input('phone', $phone)
            ->input('filters', $filter)
            ->input('possible_countries', [$countryCode])
            ->process()
            ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }
    //testSearchOfflineByPhone
    public function testSearchOfflineByPhoneMissingPhone()
    {
        $dummyProfilesData = $this->generateBulkDummyData();
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $phone = $dummyProfilesData[1]['phones'][0]['original_number'];
        $countryCode = $dummyProfilesData[1]['phones'][0]['country_code'];
        $filter = [
            'country_code' => $countryCode
        ];
        $this->expectException(MissingRequiredInputException::class);
        $profileCompositesResults = $this->searchByPhoneService
            ->input('filters', $filter)
            ->input('possible_countries', [$countryCode])
            ->process()
            ->output('result');
    }
}
