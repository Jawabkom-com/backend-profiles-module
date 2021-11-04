<?php

namespace Jawabkom\Backend\Module\Profile\Test\Integration;


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
use Jawabkom\Standard\Contract\IDependencyInjector;

class MapperArrayEntityArrayTest extends AbstractTestCase
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

    public function testArray2ProfileEntity2ArrayMapping()
    {
        $originalArray =  $this->dummyBasicProfileData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileEmailEntity2ArrayMapping()
    {
        $originalArray = $this->dummyEmailsData();
        $originalArray['esp_domain'] =  null;
        $toProfileEntityMapper = $this->di->make(IArrayToProfileEmailEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileEmailEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileAddressEntity2ArrayMapping()
    {
        $originalArray = $this->dummyAddressData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileAddressEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileAddressEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileCriminalRecordEntity2ArrayMapping()
    {
        $originalArray = $this->dummyCriminalRecordsData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileCriminalRecordEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileCriminalRecordEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileEducationsEntity2ArrayMapping()
    {
        $originalArray = $this->dummyEducationsData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileEducationEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileEducationEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileImagesEntity2ArrayMapping()
    {
        $originalArray = $this->dummyImagesData();
        $originalArray['local_path'] =  null;
        $toProfileEntityMapper = $this->di->make(IArrayToProfileImageEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileImageEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileJobsEntity2ArrayMapping()
    {
        $originalArray = $this->dummyjobsData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileJobEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileJobEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileLanguagesEntity2ArrayMapping()
    {
        $originalArray = $this->dummyLanguagesData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileLanguageEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileLanguageEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileMetaDataEntity2ArrayMapping()
    {
        $originalArray = $this->dummyMetaData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileMetaDataEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileMetaDataEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        dd($originalArray  , $aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }


    public function testArray2ProfileNameEntity2ArrayMapping()
    {
        $originalArray = $this->dummyNamesData();
        $originalArray['display'] = null;
        $toProfileEntityMapper = $this->di->make(IArrayToProfileNameEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileNameEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }


    public function testArray2ProfilePhoneEntity2ArrayMapping()
    {
        $originalArray = $this->dummyPhoneData();
        $originalArray['valid_phone'] =  false;
        $originalArray['formatted_number'] = null;
        $toProfileEntityMapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfilePhoneEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileRelationshipEntity2ArrayMapping()
    {
        $originalArray = $this->dummyRelationshipsData();
        $originalArray['person_id'] = 'person_id';
        $toProfileEntityMapper = $this->di->make(IArrayToProfileRelationshipEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileRelationshipEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileSkillEntity2ArrayMapping()
    {
        $originalArray = $this->dummySkillsData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileSkillEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileSkillEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileSocialProfileEntity2ArrayMapping()
    {
        $originalArray = $this->dummysSocialProfilesData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileSocialProfileEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileSocialProfileEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }

    public function testArray2ProfileUsernameEntity2ArrayMapping()
    {
        $originalArray = $this->dummyUsernamesData();
        $toProfileEntityMapper = $this->di->make(IArrayToProfileUsernameEntityMapper::class);
        $aMappedEntity = $toProfileEntityMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileUsernameEntityToArrayMapper::class);
        $aMappedArray = $toArrayMapper->map($aMappedEntity);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedArray));
    }


    protected function hashSerializeObject($originEntity)
    {
        $tmp1 =  preg_split('#[\{\};]#',serialize($originEntity));
        sort($tmp1);
        return sha1(implode(';',$tmp1));
    }


}
