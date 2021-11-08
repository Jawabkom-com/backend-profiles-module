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

class SearchOfflineByUsernameTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private DI $di;
    /**
     * @var SearchOfflineByUserName|mixed
     */
    private mixed $searchByUserNameService;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchByUserNameService = $this->di->make(SearchOfflineByUserName::class);
        $this->faker = Factory::create();
    }

    //testSearchOfflineWithEmail
    public function testSearchOfflineByUserName()
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
            'email' => $email
        ];
        $profileCompositesResults = $this->searchByUserNameService->input('username', $userName)
                                                               ->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }
    //testSearchOfflineByEmailWithCompositeFAlterEmail
    public function testSearchOfflineByEmailWithCompositeFAlterEmail()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $dummyProfilesData[2]['usernames'][0]['username'] = $userName;
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }


        $email = $dummyProfilesData[1]['emails'][0]['email'];

        $filter = [
            'email' => $email,
        ];
        $profileCompositesResults = $this->searchByUserNameService->input('username', $userName)
                                                                    ->input('filters', $filter)
                                                                    ->process()
                                                                    ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }
    public function testSearchOfflineByEmailWithCompositeFAlterName()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $dummyProfilesData[2]['usernames'][0]['username'] = $userName;
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }


        $name  = $dummyProfilesData[1]['names'][0]['prefix'] .' ';
        $name .= $dummyProfilesData[1]['names'][0]['first'] .' ';
        $name .= $dummyProfilesData[1]['names'][0]['middle']. ' ';
        $name .= $dummyProfilesData[1]['names'][0]['last'];

        $filter = [
            'name' => $name,
        ];
        $profileCompositesResults = $this->searchByUserNameService->input('username', $userName)
                                                                    ->input('filters', $filter)
                                                                    ->process()
                                                                    ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }

    //testSearchOfflineByEmailServiceMissingUserName
        public function testSearchOfflineByUserNameServiceMissingUserName()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $email = $dummyProfilesData[1]['emails'][0]['email'];
        $filter = [
            'email' => $email
        ];
        $this->expectException(MissingRequiredInputException::class);
        $profileCompositesResults = $this->searchByUserNameService->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
    }
}
