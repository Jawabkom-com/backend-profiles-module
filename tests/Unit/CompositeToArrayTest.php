<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CompositeToArrayTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private SearchOfflineByFilters $searchOfflineByFilters;
    private \Faker\Generator $faker;
    private IDependencyInjector $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->searchOfflineByFilters = $this->di->make(SearchOfflineByFilters::class);
        $this->faker = Factory::create();
    }

//    public function testMapProfileWithProfileIDToArray()
//    {
//        $dummyBasicData = $this->dummyBasicProfileData();
//        $uuidFactory = $this->di->make(IProfileUuidFactory::class);
//        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
//        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
//
//        /**@var $IProfileEntity IProfileEntity */
//        $IProfileEntity = $this->di->make(IProfileEntity::class);
//        $IProfileEntity->setGender($dummyBasicData['gender'] ?? null);
//        $IProfileEntity->setDataSource($dummyBasicData['data_source'] ?? null);
//        $IProfileEntity->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
//        $IProfileEntity->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);
//        $IProfileEntity->setProfileId($uuidFactory->generate());
//        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->mapProfile($IProfileEntity,true);
//        $this->assertCount(5, $profileCompositeToArrayMapper);
//    }


//    public function testMapEmailToArray()
//    {
//        $dummyEmailData = $this->dummyEmailsData();
//
//        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
//        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
//
//        /**@var $IProfileEmailEntity IProfileEmailEntity */
//        $IProfileEmailEntity = $this->di->make(IProfileEmailEntity::class);
//        $IProfileEmailEntity->setValidSince(!empty($dummyEmailData['valid_since']) ? new \DateTime($dummyEmailData['valid_since']) : null);
//        $IProfileEmailEntity->setEmail($dummyEmailData['email'] ?? null);
//        $IProfileEmailEntity->setEspDomain($dummyEmailData['esp_domain'] ?? null);
//        $IProfileEmailEntity->setType($dummyEmailData['type'] ?? null);
//        $profileEmailFillArray = [];
//        array_push($profileEmailFillArray, $IProfileEmailEntity);
//        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->mapEmails($profileEmailFillArray);
//        $this->assertCount(1, $profileCompositeToArrayMapper);
//    }

//    public function testMapSkillToArray()
//    {
//        $dummySkillData = $this->dummySkillsData();
//        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
//        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
//
//        /**@var $IProfileSkillEntity IProfileSkillEntity */
//        $IProfileSkillEntity = $this->di->make(IProfileSkillEntity::class);
//        $IProfileSkillEntity->setValidSince(!empty($dummySkillData['valid_since']) ? new \DateTime($dummySkillData['valid_since']) : null);
//        $IProfileSkillEntity->setLevel($dummySkillData['level'] ?? null);
//        $IProfileSkillEntity->setSkill($dummySkillData['skill'] ?? null);
//        $profileSkillFillArray = [];
//        array_push($profileSkillFillArray, $IProfileSkillEntity);
//        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->mapSkills($profileSkillFillArray);
//        $this->assertCount(1, $profileCompositeToArrayMapper);
//    }
//
//    public function testMapCriminalRecordToArray()
//    {
//        $dummyCriminalRecordData = $this->dummyCriminalRecordsData();
//        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
//        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
//
//        /**@var $IProfileCriminalRecordEntity IProfileCriminalRecordEntity */
//        $IProfileCriminalRecordEntity = $this->di->make(IProfileCriminalRecordEntity::class);
//        $IProfileCriminalRecordEntity->setCaseNumber($dummyCriminalRecordData['case_number'] ?? null);
//        $IProfileCriminalRecordEntity->setCaseType($dummyCriminalRecordData['case_type'] ?? null);
//        $IProfileCriminalRecordEntity->setCaseYear($dummyCriminalRecordData['case_year'] ?? null);
//        $IProfileCriminalRecordEntity->setCaseStatus($dummyCriminalRecordData['case_status'] ?? null);
//        $IProfileCriminalRecordEntity->setDisplay($dummyCriminalRecordData['display'] ?? null);
//        $profileCriminalRecordFillArray = [];
//        array_push($profileCriminalRecordFillArray, $IProfileCriminalRecordEntity);
//        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->mapCriminalRecords($profileCriminalRecordFillArray);
//        $this->assertCount(1, $profileCompositeToArrayMapper);
//    }
//
//    public function testMapMetaDataToArray()
//    {
//        $dummyMetaDataData = $this->dummyMetaData();
//        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
//        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
//
//        /**@var $IProfileMetaDataEntity IProfileMetaDataEntity */
//        $IProfileMetaDataEntity = $this->di->make(IProfileMetaDataEntity::class);
//        $IProfileMetaDataEntity->setMetaKey($dummyMetaDataData['key'] ?? null);
//        $IProfileMetaDataEntity->setMetaValue($dummyMetaDataData['value'] ?? null);
//        $profileMetaDataFillArray = [];
//        array_push($profileMetaDataFillArray, $IProfileMetaDataEntity);
//        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->mapMetaData($profileMetaDataFillArray);
//        $this->assertCount(1, $profileCompositeToArrayMapper);
//    }
//
//    public function testMapNameToArray()
//    {
//        $dummyNameData = $this->dummyNamesData();
//        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
//        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
//
//        /**@var $IProfileNameEntity IProfileNameEntity */
//        $IProfileNameEntity = $this->di->make(IProfileNameEntity::class);
//        $IProfileNameEntity->setFirst($dummyNameData['first'] ?? null);
//        $IProfileNameEntity->setMiddle($dummyNameData['middle'] ?? null);
//        $IProfileNameEntity->setLast($dummyNameData['last'] ?? null);
//        $IProfileNameEntity->setPrefix($dummyNameData['prefix'] ?? null);
//        $displayName = preg_replace('#[\s]+#', ' ', trim($IProfileNameEntity->getPrefix() . ' ' . $IProfileNameEntity->getFirst() . ' ' . $IProfileNameEntity->getMiddle() . ' ' . $IProfileNameEntity->getLast()));
//        $profileNameFillArray = [];
//        array_push($profileNameFillArray, $IProfileNameEntity);
//        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->mapNames($profileNameFillArray);
//        $this->assertCount(1, $profileCompositeToArrayMapper);
//    }

}
