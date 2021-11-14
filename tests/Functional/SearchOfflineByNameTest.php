<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\SearchFilter\EmailFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\PhoneNumberFilter;
use Jawabkom\Backend\Module\Profile\SearchFilter\UserNameFilter;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByEmail;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByName;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByPhone;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByUserName;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByNameTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private DI $di;
    private mixed $searchByNameService;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchByNameService = $this->di->make(SearchOfflineByName::class);
        $this->faker = Factory::create();
    }

    //testSearchOfflineByName
    public function testSearchOfflineByName()
    {
       $dummyProfilesData = $this->generateBulkDummyData(3);
       $name  = $dummyProfilesData[1]['names'][0]['prefix'] .' ';
       $name .= $dummyProfilesData[1]['names'][0]['first'] .' ';
       $name .= $dummyProfilesData[1]['names'][0]['middle']. ' ';
       $name .= $dummyProfilesData[1]['names'][0]['last'];
        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $userName = $dummyProfilesData[1]['usernames'][0]['username'];
        $filter = [
             new UserNameFilter($userName)
        ];
        $profileCompositesResults = $this->searchByNameService->input('name', $name)
                                                               ->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }
    //testSearchOfflineByEmailWithCompositeFAlter
    public function testSearchOfflineByNameWithCompositeFAlter()
    {
        $dummyProfilesData = $this->generateBulkDummyData(3);
        $prefix = $dummyProfilesData[1]['names'][0]['prefix'];
        $first  = $dummyProfilesData[1]['names'][0]['first'];
        $middle = $dummyProfilesData[1]['names'][0]['middle'];
        $last   = $dummyProfilesData[1]['names'][0]['last'];
        $name  = $prefix.' '.$first.' '.$middle.' '.$last;
        $dummyProfilesData[2]['names'][0]['prefix'] = $prefix;
        $dummyProfilesData[2]['names'][0]['first']  = $first;
        $dummyProfilesData[2]['names'][0]['middle'] = $middle;
        $dummyProfilesData[2]['names'][0]['last']   = $last;
        $dummyProfilesData[2]['phones'][0]['original_number'] ='5527153512';

        $fakeProfiles = [];
        foreach ($dummyProfilesData as $profileDummyData) {
            $fakeProfiles[] = $this->createProfile->input('profile', $profileDummyData)
                ->process()
                ->output('result');
        }
        $filter = [
           new PhoneNumberFilter('+905527153514')
        ];
        $profileCompositesResults = $this->searchByNameService->input('name', $name)
            ->input('filters', $filter)
            ->process()
            ->output('result');
        $this->assertInstanceOf(IProfileComposite::class, $profileCompositesResults[0]);
        $this->assertInstanceOf(IProfileEntity::class, $profileCompositesResults[0]->getProfile());
    }

    //testSearchOfflineByEmailServiceMissingUserName
        public function testSearchOfflineByUserNameServiceMissingName()
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
            new EmailFilter($email)
        ];
        $this->expectException(MissingRequiredInputException::class);
        $profileCompositesResults = $this->searchByNameService->input('filters', $filter)
                                                               ->process()
                                                               ->output('result');
    }
}
