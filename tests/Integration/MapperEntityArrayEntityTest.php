<?php

namespace Jawabkom\Backend\Module\Profile\Test\Integration;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileAddressEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileCriminalRecordEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEducationEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEmailEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileImageEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileJobEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileLanguageEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileMetaDataEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileNameEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfilePhoneEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileRelationshipEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileSkillEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileSocialProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileUsernameEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileAddressEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileCriminalRecordEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEducationEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEmailEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileImageEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileJobEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileLanguageEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileMetaDataEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileNameEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfilePhoneEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileRelationshipEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSkillEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSocialProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileUsernameEntityToArrayMapper;
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
        $originEntity = $this->di->make(IProfileImageEntity::class);
        $originEntity->setOriginalUrl('http://www.url.com');
        $originEntity->setLocalPath('http://www.url.com');
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $toArrayMapper = $this->di->make(IProfileImageEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileImageEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileJobEntity2Array2ProfileJobEntityMapping()
    {
        $originEntity = $this->di->make(IProfileJobEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setFrom(new \DateTime('2021-10-01'));
        $originEntity->setTo(new \DateTime('2021-10-01'));
        $originEntity->setTitle('title');
        $originEntity->setOrganization('organization');
        $originEntity->setIndustry('industry');
        $toArrayMapper = $this->di->make(IProfileJobEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileJobEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileLanguageEntity2Array2ProfileLanguageEntityMapping()
    {
        $originEntity = $this->di->make(IProfileLanguageEntity::class);
        $originEntity->setLanguage('en');
        $originEntity->setCountry('PS');
        $toArrayMapper = $this->di->make(IProfileLanguageEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileLanguageEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileMetaDataEntity2Array2ProfileMetaDataEntityMapping()
    {
        $originEntity = $this->di->make(IProfileMetaDataEntity::class);
        $originEntity->setMetaKey('key_example');
        $originEntity->setMetaValue('value_example');
        $toArrayMapper = $this->di->make(IProfileMetaDataEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileMetaDataEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileNameEntity2Array2ProfileNameEntityMapping()
    {
        $originEntity = $this->di->make(IProfileNameEntity::class);
        $originEntity->setFirst('first');
        $originEntity->setMiddle('middle');
        $originEntity->setLast('last');
        $originEntity->setPrefix('prefix');
        $toArrayMapper = $this->di->make(IProfileNameEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileNameEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfilePhoneEntity2Array2ProfilePhoneEntityMapping()
    {
        $originEntity = $this->di->make(IProfilePhoneEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setType('type');
        $originEntity->setDoNotCallFlag(true);
        $originEntity->setCountryCode('PS');
        $originEntity->setOriginalNumber(null);
        $originEntity->setFormattedNumber(null);
        $originEntity->setValidPhone(false);
        $originEntity->setRiskyPhone(false);
        $originEntity->setDisposablePhone(false);
        $originEntity->setCarrier(null);
        $originEntity->setPurpose(null);
        $originEntity->setIndustry('industry');
        $originEntity->setPossibleCountries([]);
        $toArrayMapper = $this->di->make(IProfilePhoneEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileRelationshipEntity2Array2ProfileRelationshipEntityMapping()
    {
        $originEntity = $this->di->make(IProfileRelationshipEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setType('type');
        $originEntity->setFirstName('first_name');
        $originEntity->setLastName('last_name');
        $originEntity->setPersonId('person_id');
        $toArrayMapper = $this->di->make(IProfileRelationshipEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileRelationshipEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));

    }

    public function testProfileSkillEntity2Array2ProfileSkillEntityMapping()
    {
        $originEntity = $this->di->make(IProfileSkillEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setLevel('level');
        $originEntity->setSkill('skill');
        $toArrayMapper = $this->di->make(IProfileSkillEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileSkillEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileSocialProfileEntity2Array2ProfileSocialProfileEntityMapping()
    {
        $originEntity = $this->di->make(IProfileSocialProfileEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setUrl('http://www.url.com');
        $originEntity->setType('type');
        $originEntity->setUsername('username');
        $originEntity->setAccountId('account_id');
        $toArrayMapper = $this->di->make(IProfileSocialProfileEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileSocialProfileEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));
    }

    public function testProfileUsernameEntity2Array2ProfileUsernameEntityMapping()
    {
        $originEntity = $this->di->make(IProfileUsernameEntity::class);
        $originEntity->setValidSince(new \DateTime('2021-10-01'));
        $originEntity->setUsername('username');
        $toArrayMapper = $this->di->make(IProfileUsernameEntityToArrayMapper::class);
        $aMappedEntity = $toArrayMapper->map($originEntity);
        $toProfileEntityMapper = $this->di->make(IArrayToProfileUsernameEntityMapper::class);
        $newEntity = $toProfileEntityMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originEntity), $this->hashSerializeObject($newEntity));

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
