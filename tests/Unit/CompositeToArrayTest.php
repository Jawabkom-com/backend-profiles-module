<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileCompositeToArrayMapper;
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
    private \Faker\Generator $faker;
    private IDependencyInjector $di;
    private IProfileComposite $profileComposite;
    private IProfileRepository $profileRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->profileComposite = $this->di->make(IProfileComposite::class);
        $this->profileRepository = $this->di->make(IProfileRepository::class);
        $this->faker = Factory::create();
    }

    public function testMapProfileWithProfileIDToArray()
    {
        $uuidFactory = $this->di->make(IProfileUuidFactory::class)->generate();
        $dummyBasicData = $this->dummyBasicProfileData();
        $profile = $this->profileRepository->createEntity();
        $profile->setGender($dummyBasicData['gender'] ?? null);
        $profile->setDataSource($dummyBasicData['data_source'] ?? null);
        $profile->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profile->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);
        $profile->setProfileId($uuidFactory);
        $this->profileComposite->setProfile($profile);

        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);

        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->map($this->profileComposite,true);
        $this->assertEquals($uuidFactory, $profileCompositeToArrayMapper['profile_id']);
    }


    public function testMapEmailToArray()
    {
        $dummyEmailData = $this->dummyEmailsData();
        $profile = $this->profileRepository->createEntity();

        $emailRepository = $this->di->make(IProfileEmailRepository::class);
        $newEmailEntity =  $emailRepository->createEntity();
        $newEmailEntity->setValidSince(!empty($dummyEmailData['valid_since']) ? new \DateTime($dummyEmailData['valid_since']) : null);
        $newEmailEntity->setEmail($dummyEmailData['email'] ?? null);
        $newEmailEntity->setEspDomain($dummyEmailData['esp_domain'] ?? null);
        $newEmailEntity->setType($dummyEmailData['type'] ?? null);
        $this->profileComposite->addEmail($newEmailEntity);
        $this->profileComposite->setProfile($profile);

        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->map($this->profileComposite);
        $this->assertCount(1, $profileCompositeToArrayMapper['emails']);
    }

    public function testMapSkillToArray()
    {
        $dummySkillData = $this->dummySkillsData();
        $profile = $this->profileRepository->createEntity();
        $skillRepository = $this->di->make(IProfileSkillRepository::class);
        $newSkillEntity =  $skillRepository->createEntity();
        $newSkillEntity->setValidSince(!empty($dummySkillData['valid_since']) ? new \DateTime($dummySkillData['valid_since']) : null);
        $newSkillEntity->setLevel($dummySkillData['level'] ?? null);
        $newSkillEntity->setSkill($dummySkillData['skill'] ?? null);
        $this->profileComposite->addSkill($newSkillEntity);
        $this->profileComposite->setProfile($profile);

        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);

        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->map($this->profileComposite);
        $this->assertCount(1, $profileCompositeToArrayMapper['skills']);
    }

    public function testMapCriminalRecordToArray()
    {
        $dummyCriminalRecordData = $this->dummyCriminalRecordsData();
        $profile = $this->profileRepository->createEntity();
        $criminalRecordRepository = $this->di->make(IProfileCriminalRecordRepository::class);
        $newCriminalRecordEntity =  $criminalRecordRepository->createEntity();
        $newCriminalRecordEntity->setCaseNumber($dummyCriminalRecordData['case_number'] ?? null);
        $newCriminalRecordEntity->setCaseType($dummyCriminalRecordData['case_type'] ?? null);
        $newCriminalRecordEntity->setCaseYear($dummyCriminalRecordData['case_year'] ?? null);
        $newCriminalRecordEntity->setCaseStatus($dummyCriminalRecordData['case_status'] ?? null);
        $newCriminalRecordEntity->setDisplay($dummyCriminalRecordData['display'] ?? null);
        $this->profileComposite->addCriminalRecord($newCriminalRecordEntity);
        $this->profileComposite->setProfile($profile);

        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);

        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->map($this->profileComposite);
        $this->assertCount(1, $profileCompositeToArrayMapper['criminal_records']);
    }

    public function testMapMetaDataToArray()
    {
        $dummyMetaDataData = $this->dummyMetaData();
        $profile = $this->profileRepository->createEntity();
        $metaDataRepository = $this->di->make(IProfileMetaDataRepository::class);
        $newMetaDataEntity =  $metaDataRepository->createEntity();
        $newMetaDataEntity->setMetaKey($dummyMetaDataData['key'] ?? null);
        $newMetaDataEntity->setMetaValue($dummyMetaDataData['value'] ?? null);
        $this->profileComposite->addMetaData($newMetaDataEntity);
        $this->profileComposite->setProfile($profile);

        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);
        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->map($this->profileComposite);
        $this->assertCount(1, $profileCompositeToArrayMapper['meta_data']);
    }

    public function testMapNameToArray()
    {
        $dummyNameData = $this->dummyNamesData();
        $profile = $this->profileRepository->createEntity();
        $nameRepository = $this->di->make(IProfileNameRepository::class);
        $newNameEntity =  $nameRepository->createEntity();
        $newNameEntity->setFirst($dummyNameData['first'] ?? null);
        $newNameEntity->setMiddle($dummyNameData['middle'] ?? null);
        $newNameEntity->setLast($dummyNameData['last'] ?? null);
        $newNameEntity->setPrefix($dummyNameData['prefix'] ?? null);
        $this->profileComposite->addName($newNameEntity);
        $this->profileComposite->setProfile($profile);

        /**@var $ProfileCompositeToArrayMapper ProfileCompositeToArrayMapper */
        $ProfileCompositeToArrayMapper = $this->di->make(ProfileCompositeToArrayMapper::class);

        $profileCompositeToArrayMapper = $ProfileCompositeToArrayMapper->map($this->profileComposite);
        $this->assertCount(1, $profileCompositeToArrayMapper['names']);
    }

}
