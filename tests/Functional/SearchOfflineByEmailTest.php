<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByEmail;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByPhone;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByUserName;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByEmailTest extends AbstractTestCase
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

    //testSearchOfflineWithEmail
    public function testSearchOfflineByEmail()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $email = $dummyProfilesData[1]['emails'][0]['email'];
        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $filter = [
            'username' => $userName
        ];
        $profileCompositesResults = $this->searchByEmailService->input('email', $email)
                                                               ->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }
    //testSearchOfflineByEmailWithCompositeFAlter
    public function testSearchOfflineByEmailWithCompositeFAlter()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $email = $dummyProfilesData[1]['emails'][0]['email'];
        $dummyProfilesData[0]['emails'][0]['email'] = $dummyProfilesData[1]['emails'][0]['email'];
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }

        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $filter = [
            'username' => $userName
        ];
        $profileCompositesResults = $this->searchByEmailService->input('email', $email)
                                                               ->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }

    //testSearchOfflineByEmailServiceMissingEmail
    public function testSearchOfflineByEmailServiceMissingEmail()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $email = $dummyProfilesData[1]['emails'][0]['email'];
        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $filter = [
            'username' => $userName
        ];
        $this->expectException(MissingRequiredInputException::class);
        $profileCompositesResults = $this->searchByEmailService->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
    }
    //testSearchOfflineByEmailServiceWrongFormatEmail
    public function testSearchOfflineByEmailServiceWrongFormatEmail()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $filter = [
            'username' => $userName
        ];
        $this->expectException(InvalidEmailAddressFormat::class);
        $profileCompositesResults = $this->searchByEmailService->input('email','www.people.com')
                                                               ->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
    }
}
