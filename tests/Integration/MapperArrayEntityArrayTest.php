<?php

namespace Jawabkom\Backend\Module\Profile\Test\Integration;

use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
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
        $originalArray = $this->dummyData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileEmailEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['emails'][] = $this->dummyEmailsData();
        $originalArray['emails'][0]['email'] = 'crist.isom@example.com';
        $originalArray['emails'][0]['esp_domain'] = 'example.com';
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileAddressEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['addresses'][] = $this->dummyAddressData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileCriminalRecordEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['criminal_records'][] = $this->dummyCriminalRecordsData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileEducationsEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['educations'][] = $this->dummyEducationsData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileImagesEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['images'][] = $this->dummyImagesData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);
        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileJobsEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['jobs'][] = $this->dummyjobsData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileLanguagesEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['languages'][] = $this->dummyLanguagesData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }

    public function testArray2ProfileMetaDataEntity2ArrayMapping()
    {
        $originalArray = $this->dummyData();
        $originalArray['meta_data'][] = $this->dummyMetaData();
        $toProfileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);
        $aMappedArray = $toProfileCompositeMapper->map($originalArray);

        $toArrayMapper = $this->di->make(IProfileCompositeToArrayMapper::class);
        $aMappedComposite = $toArrayMapper->map($aMappedArray);
        $this->assertEquals($this->hashSerializeObject($originalArray), $this->hashSerializeObject($aMappedComposite));
    }


    protected function hashSerializeObject($originEntity)
    {
        $tmp1 =  preg_split('#[\{\};]#',serialize($originEntity));
        sort($tmp1);
        return sha1(implode(';',$tmp1));
    }


    protected function dummyData()
    {
        $dummyData  = $this->dummyBasicProfileData();
        $dummyData['names'] = [];
        $dummyData['phones'] = [];
        $dummyData['addresses'] = [];
        $dummyData['usernames'] = [];
        $dummyData['emails'] = [];
        $dummyData['relationships'] = [];
        $dummyData['skills'] = [];
        $dummyData['images'] = [];
        $dummyData['languages'] = [];
        $dummyData['jobs'] = [];
        $dummyData['educations'] = [];
        $dummyData['social_profiles'] = [];
        $dummyData['criminal_records'] = [];
        $dummyData['meta_data'] = [];
        return $dummyData;
    }

}
