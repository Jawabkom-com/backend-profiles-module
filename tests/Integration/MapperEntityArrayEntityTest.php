<?php

namespace Jawabkom\Backend\Module\Profile\Test\Integration;

use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileAddressEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileCriminalRecordEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEducationEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEmailEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileAddressEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileCriminalRecordEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEducationEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEmailEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Service\SearchOfflineByFilters;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Profile\Profile;
use Jawabkom\Standard\Contract\IDependencyInjector;

class MapperEntityArrayEntityTest extends AbstractTestCase
{
    use DummyTrait;

    private SearchOfflineByFilters $searchOfflineByFilters;
    private \Faker\Generator $faker;
    private IDependencyInjector $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->searchOfflineByFilters = $this->di->make(SearchOfflineByFilters::class);
        $this->faker = Factory::create();
    }

    public function testProfileEntity2Array2ProfileEntityMapping()
    {
        $originEntity = $this->originalProfile();
        $toArrayMapper = $this->di->make(IProfileEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileEmailEntity2Array2ProfileEmailEntityMapping()
    {
        $originEntity = $this->di->make(IProfileEmailEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setEmail('jked@example.com');
        $originEntity->setEspDomain('example.com');
        $originEntity->setType('edjekjed');
        $toArrayMapper = $this->di->make(IProfileEmailEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileEmailEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileAddressEntity2Array2ProfileAddressEntityMapping()
    {
        $originEntity = $this->di->make(IProfileAddressEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setCountry('PS');
        $originEntity->setState('state');
        $originEntity->setCity('city');
        $originEntity->setZip('zip');
        $originEntity->setStreet('street');
        $originEntity->setBuildingNumber('3333');
        $originEntity->setDisplay('display');
        $toArrayMapper = $this->di->make(IProfileAddressEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileAddressEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileCriminalRecordEntity2Array2ProfileCriminalRecordEntityMapping()
    {
        $originEntity = $this->di->make(IProfileCriminalRecordEntity::class);
        $originEntity->setCaseNumber('Case Number');
        $originEntity->setCaseType('Case Type');
        $originEntity->setCaseYear('Case Year');
        $originEntity->setCaseStatus('Case Status');
        $originEntity->setDisplay('Display');
        $toArrayMapper = $this->di->make(IProfileCriminalRecordEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCriminalRecordEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileEducationEntity2Array2ProfileEducationEntityMapping()
    {
        $originEntity = $this->di->make(IProfileEducationEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setFrom(new \DateTime('2021-10-01'));
        $originEntity->setTo(new \DateTime('2021-10-01'));
        $originEntity->setSchool('school');
        $originEntity->setDegree('degree');
        $originEntity->setMajor('major');
        $toArrayMapper = $this->di->make(IProfileEducationEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileEducationEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));

    }

    public function testProfileImageEntity2Array2ProfileImageEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $imageRepository = $this->di->make(IProfileImageRepository::class);
        $newImageEntity =  $imageRepository->createEntity();
        $newImageEntity->setOriginalUrl('http://www.url.com');
        $newImageEntity->setLocalPath('http://www.local.com');
        $newImageEntity->setValidSince(new \DateTime('2021-10-01'));

        $originalComposite->addImage($newImageEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfileJobEntity2Array2ProfileJobEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $jobRepository = $this->di->make(IProfileJobRepository::class);
        $newJobEntity =  $jobRepository->createEntity();
        $newJobEntity->setValidSince(new \DateTime('2021-10-01'));
        $newJobEntity->setFrom(new \DateTime('2021-10-01'));
        $newJobEntity->setTo(new \DateTime('2021-10-01'));
        $newJobEntity->setTitle('title');
        $newJobEntity->setOrganization('organization');
        $newJobEntity->setIndustry('industry');

        $originalComposite->addJob($newJobEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfileLanguageEntity2Array2ProfileLanguageEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $languageRepository = $this->di->make(IProfileLanguageRepository::class);
        $newLanguageEntity =  $languageRepository->createEntity();
        $newLanguageEntity->setLanguage('en');
        $newLanguageEntity->setCountry('PS');

        $originalComposite->addLanguage($newLanguageEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfileMetaDataEntity2Array2ProfileMetaDataEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $metaDataRepository = $this->di->make(IProfileMetaDataRepository::class);
        $newMetaDataEntity =  $metaDataRepository->createEntity();
        $newMetaDataEntity->setMetaKey('key');
        $newMetaDataEntity->setMetaValue('value');

        $originalComposite->addMetaData($newMetaDataEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));

    }

    public function testProfileNameEntity2Array2ProfileNameEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $nameRepository = $this->di->make(IProfileNameRepository::class);
        $nameEntity =  $nameRepository->createEntity();
        $nameEntity->setFirst('first');
        $nameEntity->setMiddle('middle');
        $nameEntity->setLast('last');
        $nameEntity->setPrefix('prefix');

        $originalComposite->addName($nameEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfilePhoneEntity2Array2ProfilePhoneEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $phoneRepository = $this->di->make(IProfilePhoneRepository::class);
        $phoneEntity =  $phoneRepository->createEntity();
        $phoneEntity->setValidSince(new \DateTime('2021-10-01'));
        $phoneEntity->setType('type');
        $phoneEntity->setDoNotCallFlag(true);
        $phoneEntity->setCountryCode('PS');
        $phoneEntity->setOriginalNumber(null);
        $phoneEntity->setFormattedNumber(null);
        $phoneEntity->setValidPhone(false);
        $phoneEntity->setRiskyPhone(false);
        $phoneEntity->setDisposablePhone(false);
        $phoneEntity->setCarrier(null);
        $phoneEntity->setPurpose(null);
        $phoneEntity->setIndustry('industry');
        $phoneEntity->setPossibleCountries([]);

        $originalComposite->addPhone($phoneEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfileRelationshipEntity2Array2ProfileRelationshipEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $relationshipRepository = $this->di->make(IProfileRelationshipRepository::class);
        $relationshipEntity =  $relationshipRepository->createEntity();
        $relationshipEntity->setValidSince(new \DateTime('2021-10-01'));
        $relationshipEntity->setType('type');
        $relationshipEntity->setFirstName('first_name');
        $relationshipEntity->setLastName('last_name');
        $relationshipEntity->setPersonId('person_id');

        $originalComposite->addRelationship($relationshipEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));

    }

    public function testProfileSkillEntity2Array2ProfileSkillEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $skillRepository = $this->di->make(IProfileSkillRepository::class);
        $skillEntity =  $skillRepository->createEntity();
        $skillEntity->setValidSince(new \DateTime('2021-10-01'));
        $skillEntity->setLevel('level');
        $skillEntity->setSkill('skill');

        $originalComposite->addSkill($skillEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfileSocialProfileEntity2Array2ProfileSocialProfileEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $socialProfileRepository = $this->di->make(IProfileSocialProfileRepository::class);
        $socialProfileEntity =  $socialProfileRepository->createEntity();
        $socialProfileEntity->setValidSince(new \DateTime('2021-10-01'));
        $socialProfileEntity->setUrl('http://www.url.com');
        $socialProfileEntity->setType('type');
        $socialProfileEntity->setUsername('username');
        $socialProfileEntity->setAccountId('account_id');

        $originalComposite->addSocialProfile($socialProfileEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function testProfileUsernameEntity2Array2ProfileUsernameEntityMapping()
    {
        $originalComposite = $this->di->make(IProfileComposite::class);
        $originEntity = $this->originalProfile();

        $usernameRepository = $this->di->make(IProfileUsernameRepository::class);
        $usernameEntity =  $usernameRepository->createEntity();
        $usernameEntity->setValidSince(new \DateTime('2021-10-01'));
        $usernameEntity->setUsername('username');

        $originalComposite->addUsername($usernameEntity);
        $originalComposite->setProfile($originEntity);
        $profileCompositeToArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite  =  $profileCompositeToArrayMapper->map($originalComposite);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $newComposite = $toProfileEntityMapper->map($aMappedComposite);
        $this->assertEquals($this->hashSerializeObject($originalComposite), $this->hashSerializeObject($newComposite));
    }

    public function originalProfile() : Profile
    {
        $originEntity = $this->di->make(IProfileEntity::class);
        $originEntity->setDataSource('test_data_source');
        $originEntity->setPlaceOfBirth('JO');
        $originEntity->setGender('male');
        $originEntity->setDateOfBirth(new \DateTime('2021-10-01'));
        return $originEntity;
    }

    protected function hashSerializeObject($originEntity)
    {
        $tmp1 =  preg_split('#[\{\};]#',serialize($originEntity));
        sort($tmp1);
        return sha1(implode(';',$tmp1));
    }





}
