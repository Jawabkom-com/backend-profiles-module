<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Similarity\ISimilarityCompositeScore;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;

class SimilarityCompositeScoreTest extends AbstractTestCase
{
    use DummyTrait;
    private \Faker\Generator $faker;
    /**
     * @var ISimilarityCompositeScore|mixed
     */
    private mixed $similarityService;
    private $profileCompositeMapper;

    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
        $this->profileCompositeMapper = $di->make(IArrayToProfileCompositeMapper::class);
        $this->similarityService = $di->make(ISimilarityCompositeScore::class);
        $this->faker = Factory::create();
    }

    public function testSimilarityCompositeScore(){
        $userData = $this->dummyFullProfileData();
        $profileCompositeOne       = $this->profileCompositeMapper->map($userData);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userData);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('90',$score);
    }

    public function testOneSimilarEmail_NoNameSimilarity()
    {
        // < 50
        $email       = $this->dummyEmailsData();
        $userDataOne = $this->dummyBasicProfileData();
        $userDataOne['emails'][]=$email;
        $userDataOne['names'][]=$this->dummyNamesData();
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][]=$email;
        $userDataTwo['names'][]=$this->dummyNamesData();

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertLessThan('50',$score);

    }

    public function testOneSimilarPhone_NoNameSimilarity()
    {
        // < 50
        $phone       = $this->dummyEmailsData();
        $userDataOne = $this->dummyBasicProfileData();
        $userDataOne['phones'][]=$phone;
        $userDataOne['names'][]=$this->dummyNamesData();
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['phones'][]=$phone;
        $userDataTwo['names'][]=$this->dummyNamesData();

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertLessThan('50',$score);

    }

    public function testOneUsernameSimilarity_NameSimilarity()
    {
        // < 50
        $name        = $this->dummyNamesData();
        $name2       = $name;
        $name2['last'] = $name['last'].' '.$this->faker->lastName;
        $username    = $this->dummyEmailsData();
        $userDataOne = $this->dummyBasicProfileData();
        $userDataOne['names'][]=$name;
        $userDataOne['usernames'][]=$username;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['names'][]=$name2;
        $userDataTwo['usernames'][]=$username;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertLessThan('50',$score);

    }

    public function testOneUsernameSimilarity_FullNameSimilarity()
    {
        // > 50
        $name1        = $this->dummyNamesData();
        $name2        = $this->dummyNamesData();
        $name3        = $this->dummyNamesData();
        $username    = $this->dummyUsernamesData();
        $userDataOne = $this->dummyBasicProfileData();
        $userDataOne['names'][]=$name1;
        $userDataOne['names'][]=$name2;
        $userDataOne['names'][]=$name3;
        $userDataOne['usernames'][]=$username;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['names'][]=$name1;
        $userDataTwo['names'][]=$name2;
        $userDataTwo['names'][]=$name3;
        $userDataTwo['usernames'][]=$username;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testTwoUsernameSimilarity_NameSimilarity()
    {
        // > 50
        $name        = $this->dummyNamesData();
        $username1    = $this->dummyUsernamesData();
        $username2    = $this->dummyEmailsData();
        $userDataOne = $this->dummyBasicProfileData();
        $userDataOne['names'][]=$name;
        $userDataOne['usernames'][]=$username1;
        $userDataOne['usernames'][]=$username2;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['names'][]=$name;
        $userDataTwo['usernames'][]=$username1;
        $userDataTwo['usernames'][]=$username2;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);
    }

    public function testTwoUsernameSimilarity_TwoNameSimilarity()
    {
        // > 50
        $name1        = $this->dummyNamesData();
        $name2        = $this->dummyNamesData();
        $username1    = $this->dummyUsernamesData();
        $username2    = $this->dummyEmailsData();
        $userDataOne = $this->dummyBasicProfileData();
        $userDataOne['names'][]=$name1;
        $userDataOne['names'][]=$name2;
        $userDataOne['usernames'][]=$username1;
        $userDataOne['usernames'][]=$username2;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['names'][]=$name1;
        $userDataTwo['names'][]=$name2;
        $userDataTwo['usernames'][]=$username1;
        $userDataTwo['usernames'][]=$username2;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);
    }

    public function testOneSimilarPhone_UsernameSimilarity()
    {
        // > 50
        $phone        = $this->dummyPhoneData();
        $username    = $this->dummyUsernamesData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['phones'][]=$phone;
        $userDataOne['usernames'][]=$username;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['phones'][]=$phone;
        $userDataTwo['usernames'][]=$username;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testOneSimilarEmail_UsernameSimilarity()
    {
        // > 50
        $email        = $this->dummyEmailsData();
        $username    = $this->dummyUsernamesData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['emails'][]=$email;
        $userDataOne['usernames'][]=$username;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][]=$email;
        $userDataTwo['usernames'][]=$username;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testOneSimilarEmail_NameSimilarity()
    {
        // > 50
        $email        = $this->dummyEmailsData();
        $name         = $this->dummyNamesData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['emails'][]=$email;
        $userDataOne['names'][]=$name;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][]=$email;
        $userDataTwo['names'][]=$name;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testOneSimilarEmail_OneSimilarPhone_NameSimilarity()
    {
        // > 50
        $email        = $this->dummyEmailsData();
        $phone    = $this->dummyPhoneData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['emails'][]=$email;
        $userDataOne['phones'][]=$phone;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][]=$email;
        $userDataTwo['phones'][]=$phone;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testOneSimilarEmail_OneSimilarPhone_NoNameSimilarity()
    {
        // > 50
        $email        = $this->dummyEmailsData();
        $phone        = $this->dummyPhoneData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['emails'][]=$email;
        $userDataOne['phones'][]=$phone;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][]=$email;
        $userDataTwo['phones'][]=$phone;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testTwoSimilarEmails_NoNameSimilarity()
    {
        // > 50
        $email1        = $this->dummyEmailsData();
        $email2        = $this->dummyEmailsData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['emails'][]=$email1;
        $userDataOne['emails'][]=$email2;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][]=$email1;
        $userDataTwo['emails'][]=$email2;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testTwoSimilarEmails_NameSimilarity()
    {
        // > 50
        $email1        = $this->dummyEmailsData();
        $email2        = $this->dummyEmailsData();
        $name        = $this->dummyNamesData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['emails'][] = $email1;
        $userDataOne['emails'][] = $email2;
        $userDataOne['names'][] = $name;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['emails'][] = $email1;
        $userDataTwo['emails'][] = $email2;
        $userDataTwo['names'][] = $name;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testTwoSimilarPhones_NameSimilarity()
    {
        // > 50
        $phone1        = $this->dummyPhoneData();
        $phone2        = $this->dummyPhoneData();
        $name        = $this->dummyNamesData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['phones'][] = $phone1;
        $userDataOne['phones'][] = $phone2;
        $userDataOne['names'][] = $name;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['phones'][] = $phone1;
        $userDataTwo['phones'][] = $phone2;
        $userDataTwo['names'][] = $name;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }

    public function testTwoSimilarPhones_NoNameSimilarity()
    {
        // > 50
        $phone1        = $this->dummyPhoneData();
        $phone2        = $this->dummyPhoneData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['phones'][] = $phone1;
        $userDataOne['phones'][] = $phone2;
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['phones'][] = $phone1;
        $userDataTwo['phones'][] = $phone2;

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);

    }



    public function testOneSimilarPhones_50PercentNameSimilarity()
    {
        // > 50
        $phone1        = $this->dummyPhoneData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['phones'][] = $phone1;
        $userDataOne['names'][] = ['first' => 'Ahmad', 'last' => 'Saleh'];
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['phones'][] = $phone1;
        $userDataTwo['names'][] = ['first' => 'Ahmad', 'last' => 'Fathi'];

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);
    }

    public function testOneSimilarPhones_50PercentNameSimilarity_SmallLetter()
    {
        // > 50
        $phone1        = $this->dummyPhoneData();
        $userDataOne = $this->dummyBasicProfileData();

        $userDataOne['phones'][] = $phone1;
        $userDataOne['names'][] = ['first' => 'ahmad', 'last' => 'Saleh'];
        $userDataTwo = $this->dummyBasicProfileData();
        $userDataTwo['phones'][] = $phone1;
        $userDataTwo['names'][] = ['first' => 'Ahmad', 'last' => 'Fathi'];

        $profileCompositeOne       = $this->profileCompositeMapper->map($userDataOne);
        $profileCompositeTwo       = $this->profileCompositeMapper->map($userDataTwo);

        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeOne);
        $this->assertInstanceOf(IProfileComposite::class,$profileCompositeTwo);
        $score = $this->similarityService->calculate($profileCompositeOne,$profileCompositeTwo);
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
        $this->assertGreaterThan('50',$score);
    }

}
