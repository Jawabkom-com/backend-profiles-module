<?php

namespace Functional;

use Carbon\Carbon;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\{
    IProfileAddressHashGenerator,
    IProfileCriminalRecordHashGenerator,
    IProfileEducationHashGenerator,
    IProfileEmailHashGenerator,
    IProfileHashGenerator,
    IProfileImageHashGenerator,
    IProfileJobHashGenerator,
    IProfileLanguageHashGenerator,
    IProfileMetaDataHashGenerator,
    IProfileNameHashGenerator,
    IProfilePhoneHashGenerator,
    IProfileRelationsHashGenerator,
    IProfileSkillHashGenerator,
    IProfileSocialProfileHashGenerator,
    IProfileUsernameHashGenerator,
};
use Jawabkom\Backend\Module\Profile\{
    Contract\IArrayHashing,
    Service\CreateProfile,
    Test\AbstractTestCase,
    Test\Classes\DI,
    Test\Classes\DummyTrait,
};

class EntityHashingTest extends AbstractTestCase
{
    use DummyTrait;

    /**
     * @var CreateProfile|mixed
     */
    private mixed $createProfile;
    private \Faker\Generator $faker;
    private DI $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->faker = Factory::create();

    }

    public function testEntityHashing()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        foreach ($fakeProfile->getAddresses() as $address) {
            $addressHashing[] = $addressHashGenerator->generate($address, $arrayHashing);
        }
        $this->assertNotEmpty($addressHashing);
        $this->assertIsString($addressHashing[0]);

        $emailHashGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($fakeProfile->getEmails() as $email) {
            $emailHashing[] = $emailHashGenerator->generate($email, $arrayHashing);
        }
        $this->assertNotEmpty($emailHashing);
        $this->assertIsString($emailHashing[0]);

        $usernameHashGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        foreach ($fakeProfile->getUsernames() as $username) {
            $usernameHashing[] = $usernameHashGenerator->generate($username, $arrayHashing);
        }
        $this->assertNotEmpty($usernameHashing);
        $this->assertIsString($usernameHashing[0]);

        $educationHashGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        foreach ($fakeProfile->getEducations() as $education) {
            $educationHashing[] = $educationHashGenerator->generate($education, $arrayHashing);
        }
        $this->assertNotEmpty($educationHashing);
        $this->assertIsString($educationHashing[0]);

        $phoneHashGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        foreach ($fakeProfile->getPhones() as $phone) {
            $phoneHashing[] = $phoneHashGenerator->generate($phone, $arrayHashing);
        }
        $this->assertNotEmpty($phoneHashing);
        $this->assertIsString($phoneHashing[0]);

        $criminalRecordHashGenerator = $this->di->make(IProfileCriminalRecordHashGenerator::class);
        foreach ($fakeProfile->getCriminalRecords() as $criminalRecord) {
            $criminalRecordHashing[] = $criminalRecordHashGenerator->generate($criminalRecord, $arrayHashing);
        }
        $this->assertNotEmpty($criminalRecordHashing);
        $this->assertIsString($criminalRecordHashing[0]);

        $imageHashGenerator = $this->di->make(IProfileImageHashGenerator::class);
        foreach ($fakeProfile->getImages() as $image) {
            $imageHashing[] = $imageHashGenerator->generate($image, $arrayHashing);
        }
        $this->assertNotEmpty($imageHashing);
        $this->assertIsString($imageHashing[0]);

        $jobHashGenerator = $this->di->make(IProfileJobHashGenerator::class);
        foreach ($fakeProfile->getJobs() as $job) {
            $jobHashing[] = $jobHashGenerator->generate($job, $arrayHashing);
        }
        $this->assertNotEmpty($jobHashing);
        $this->assertIsString($jobHashing[0]);

        $languageHashGenerator = $this->di->make(IProfileLanguageHashGenerator::class);
        foreach ($fakeProfile->getLanguages() as $language) {
            $languageHashing[] = $languageHashGenerator->generate($language, $arrayHashing);
        }
        $this->assertNotEmpty($languageHashing);
        $this->assertIsString($languageHashing[0]);

        $metaDataHashGenerator = $this->di->make(IProfileMetaDataHashGenerator::class);
        foreach ($fakeProfile->getMetaData() as $metaData) {
            $metaDataHashing[] = $metaDataHashGenerator->generate($metaData, $arrayHashing);
        }
        $this->assertNotEmpty($metaDataHashing);
        $this->assertIsString($metaDataHashing[0]);

        $nameHashGenerator = $this->di->make(IProfileNameHashGenerator::class);
        foreach ($fakeProfile->getNames() as $name) {
            $nameHashing[] = $nameHashGenerator->generate($name, $arrayHashing);
        }
        $this->assertNotEmpty($nameHashing);
        $this->assertIsString($nameHashing[0]);

        $relationsHashGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        foreach ($fakeProfile->getRelationships() as $relations) {
            $relationsHashing[] = $relationsHashGenerator->generate($relations, $arrayHashing);
        }
        $this->assertNotEmpty($relationsHashing);
        $this->assertIsString($relationsHashing[0]);

        $skillHashGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        foreach ($fakeProfile->getSkills() as $skill) {
            $skillHashing[] = $skillHashGenerator->generate($skill, $arrayHashing);
        }
        $this->assertNotEmpty($skillHashing);
        $this->assertIsString($skillHashing[0]);

        $socialProfileHashGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        foreach ($fakeProfile->getSocialProfiles() as $socialProfile) {
            $socialProfileHashing[] = $socialProfileHashGenerator->generate($socialProfile, $arrayHashing);
        }
        $this->assertNotEmpty($socialProfileHashing);
        $this->assertIsString($socialProfileHashing[0]);

        $profileHashGenerator = $this->di->make(IProfileHashGenerator::class);
        $profileHashing = $profileHashGenerator->generate($fakeProfile->getProfile(), $arrayHashing);
        $this->assertNotEmpty($profileHashing);
        $this->assertIsString($profileHashing[0]);
    }

    public function testAddressHashingWithDifferentProfiles()
    {
        $dummyProfilesData = $this->generateBulkDummyData();
        $fakeProfileOne = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $fakeProfileTwo = $this->createProfile->input('profile', $dummyProfilesData[1])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileIdOne = $fakeProfileOne->getProfile()->getProfileId();
        $profileIdTwo = $fakeProfileTwo->getProfile()->getProfileId();
        $addressHashingOne = $addressHashGenerator->generate($fakeProfileOne->getAddresses()[0], $arrayHashing);
        $addressHashingTwo = $addressHashGenerator->generate($fakeProfileTwo->getAddresses()[0], $arrayHashing);
        $this->assertIsString($addressHashingOne);
        $this->assertIsString($addressHashingTwo);
        $this->assertNotEquals($addressHashingOne, $addressHashingTwo);
    }

    public function testAddressHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $address = $fakeProfile->getAddresses()[0];
        $addressHashingOne = $addressHashGenerator->generate($address, $arrayHashing);
        $address->setValidSince(Carbon::now());
        $addressHashingTwo = $addressHashGenerator->generate($address, $arrayHashing);
        $this->assertIsString($addressHashingOne);
        $this->assertEquals($addressHashingOne, $addressHashingTwo);
    }

    public function testEducationHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $educationHashGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $education = $fakeProfile->getEducations()[0];
        $educationHashingOne = $educationHashGenerator->generate($education, $arrayHashing);
        $education->setValidSince(Carbon::now());
        $educationHashingTwo = $educationHashGenerator->generate($education, $arrayHashing);
        $this->assertIsString($educationHashingOne);
        $this->assertEquals($educationHashingOne, $educationHashingTwo);
    }

    public function testEducationHashingWithSameProfileWithDifferentFromAndToDate()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $educationHashGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $education = $fakeProfile->getEducations()[0];
        $educationHashingOne = $educationHashGenerator->generate($education, $arrayHashing);
        $education->setFrom(Carbon::now());
        $education->setTo(Carbon::now());
        $educationHashingTwo = $educationHashGenerator->generate($education, $arrayHashing);
        $this->assertIsString($educationHashingOne);
        $this->assertEquals($educationHashingOne, $educationHashingTwo);
    }

    public function testEmailHashingWithSameProfileWithDifferentValidSinceAndEspDomain()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $emailHashGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $email = $fakeProfile->getEmails()[0];
        $emailHashingOne = $emailHashGenerator->generate($email, $arrayHashing);
        $email->setValidSince(Carbon::now());
        $email->setEspDomain('jawabkom');
        $emailHashingTwo = $emailHashGenerator->generate($email, $arrayHashing);
        $this->assertIsString($emailHashingOne);
        $this->assertEquals($emailHashingOne, $emailHashingTwo);
    }

    public function testImageHashingWithSameProfileWithDifferentValidSinceAndLocalPath()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $imageHashGenerator = $this->di->make(IProfileImageHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $image = $fakeProfile->getImages()[0];
        $imageHashingOne = $imageHashGenerator->generate($image, $arrayHashing);
        $image->setValidSince(Carbon::now());
        $image->setLocalPath($this->faker->imageUrl);
        $imageHashingTwo = $imageHashGenerator->generate($image, $arrayHashing);
        $this->assertIsString($imageHashingOne);
        $this->assertEquals($imageHashingOne, $imageHashingTwo);
    }

    public function testJobHashingWithSameProfileWithDifferentValidSinceAndFromAndToDate()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $jobHashGenerator = $this->di->make(IProfileJobHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $job = $fakeProfile->getJobs()[0];
        $jobHashingOne = $jobHashGenerator->generate($job, $arrayHashing);
        $job->setValidSince(Carbon::now());
        $job->setFrom(Carbon::now()->subYears(10));
        $job->setTo(Carbon::now()->addYears(5));
        $jobHashingTwo = $jobHashGenerator->generate($job, $arrayHashing);
        $this->assertIsString($jobHashingOne);
        $this->assertEquals($jobHashingOne, $jobHashingTwo);
    }

    public function testNameHashingWithSameProfileWithDisplay()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $nameHashGenerator = $this->di->make(IProfileNameHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $name = $fakeProfile->getNames()[0];
        $nameHashingOne = $nameHashGenerator->generate($name, $arrayHashing);
        $name->setDisplay('test name display');
        $nameHashingTwo = $nameHashGenerator->generate($name, $arrayHashing);
        $this->assertIsString($nameHashingOne);
        $this->assertEquals($nameHashingOne, $nameHashingTwo);
    }

    public function testPhoneHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $phoneHashGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $phone = $fakeProfile->getPhones()[0];
        $phoneHashingOne = $phoneHashGenerator->generate($phone, $arrayHashing);
        $phone->setValidSince(Carbon::now());
        $phoneHashingTwo = $phoneHashGenerator->generate($phone, $arrayHashing);
        $this->assertIsString($phoneHashingOne);
        $this
            ->assertEquals($phoneHashingOne, $phoneHashingTwo);
    }

    public function testRelationsHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $relationsHashGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $relations = $fakeProfile->getRelationships()[0];
        $relationsHashingOne = $relationsHashGenerator->generate($relations, $arrayHashing);
        $relations->setValidSince(Carbon::now());
        $relationsHashingTwo = $relationsHashGenerator->generate($relations, $arrayHashing);
        $this->assertIsString($relationsHashingOne);
        $this->assertEquals($relationsHashingOne, $relationsHashingTwo);
    }

    public function testSkillHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $skillHashGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $skill = $fakeProfile->getSkills()[0];
        $skillHashingOne = $skillHashGenerator->generate($skill, $arrayHashing);
        $skill->setValidSince(Carbon::now());
        $skillHashingTwo = $skillHashGenerator->generate($skill, $arrayHashing);
        $this->assertIsString($skillHashingOne);
        $this->assertEquals($skillHashingOne, $skillHashingTwo);
    }

    public function testSocialProfileHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $socialProfileHashGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $socialProfile = $fakeProfile->getSocialProfiles()[0];
        $socialProfileHashingOne = $socialProfileHashGenerator->generate($socialProfile, $arrayHashing);
        $socialProfile->setValidSince(Carbon::now());
        $socialProfileHashingTwo = $socialProfileHashGenerator->generate($socialProfile, $arrayHashing);
        $this->assertIsString($socialProfileHashingOne);
        $this->assertEquals($socialProfileHashingOne, $socialProfileHashingTwo);
    }

    public function testUsernameHashingWithSameProfileWithDifferentValidSince()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $usernameHashGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        $username = $fakeProfile->getUsernames()[0];
        $usernameHashingOne = $usernameHashGenerator->generate($username, $arrayHashing);
        $username->setValidSince(Carbon::now());
        $usernameHashingTwo = $usernameHashGenerator->generate($username, $arrayHashing);
        $this->assertIsString($usernameHashingOne);
        $this->assertEquals($usernameHashingOne, $usernameHashingTwo);
    }

}