<?php

namespace Jawabkom\Backend\Module\Profile\Test\Integration;


use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositeScoring;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CompositeScoringTest extends AbstractTestCase
{
    use DummyTrait;

    private \Faker\Generator $faker;
    private IDependencyInjector $di;
    private mixed $profileCompositeMapper;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->faker = Factory::create();
        $this->profileCompositeMapper = $this->di->make(IArrayToProfileCompositeMapper::class);

    }


    public function testCompositeScore_ProfileName()
    {
       $userData['names']=[
            $this->dummyNamesData(),
            $this->dummyNamesData(),
        ];

        $profileComposite       = $this->profileCompositeMapper->map($userData);
        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);
        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(30,$compositeScore);
    }

    public function testCompositeScore_ProfilePhone()
    {

        $userData['phones']=[
            $this->dummyPhoneData(),
            $this->dummyPhoneData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(30,$compositeScore);

    }

    public function testCompositeScore_ProfileAddress()
    {
        $userData['addresses']=[
            $this->dummyAddressData(),
            $this->dummyAddressData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);
    }

    public function testCompositeScore_Relationships()
    {
        $userData['relationships']=[
            $this->dummyRelationshipsData(),
            $this->dummyAddressData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(10,$compositeScore);
    }

    public function testCompositeScore_ProfileSkills()
    {
        $userData['skills']=[
            $this->dummySkillsData(),
            $this->dummySkillsData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);
    }

    public function testCompositeScore_CriminalRecords()
    {
        $userData['criminal_records']=[
            $this->dummyCriminalRecordsData(),
            $this->dummyCriminalRecordsData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);
    }

    public function testCompositeScore_SocialProfiles()
    {
        $userData['social_profiles']=[
            $this->dummysSocialProfilesData(),
            $this->dummysSocialProfilesData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);
    }

    public function testCompositeScore_Languages()
    {
        $userData['languages']=[
            $this->dummyLanguagesData(),
            $this->dummyLanguagesData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);
    }

    public function testCompositeScore_Images()
    {
        $userData['images']=[
            $this->dummyImagesData(),
            $this->dummyImagesData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);
    }

    public function testCompositeScore_Meta()
    {
        $userData['meta_data']=[
            $this->dummyMetaData(),
            $this->dummyMetaData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertEquals(0,$compositeScore);
    }

    public function testCompositeScore_ProfileEducation()
    {
        $userData['educations']=[
            $this->dummyEducationsData(),
            $this->dummyEducationsData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);

    }

    public function testCompositeScore_ProfileJob()
    {
        $userData['jobs']=[
            $this->dummyjobsData(),
            $this->dummyjobsData(),
        ];
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(5,$compositeScore);

    }

    public function testCompositeScore_ProfileDateOfBirth()
    {
        $userData = $this->dummyBasicProfileData();
        unset($userData['place_of_birth']);

        $profileComposite       = $this->profileCompositeMapper->map($userData);
        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(10,$compositeScore);

    }

    public function testCompositeScore_ProfilePlaceOfBirth()
    {
        $userData = $this->dummyBasicProfileData();
        unset($userData['date_of_birth']);
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertEquals(10,$compositeScore);
    }

    public function testCompositeScore_withAll()
    {
        $userData = $this->dummyFullProfileData();
        $profileComposite       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileComposite);

        $compositeScoreService = $this->di->make(ICompositeScoring::class);
        $compositeScore = $compositeScoreService->score($profileComposite);
        $this->assertNotEmpty($compositeScore);
        $this->assertIsNumeric($compositeScore);
        $this->assertNotEquals(0,$compositeScore);
    }


}
