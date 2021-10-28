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

    public function testEntityHasing()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        foreach ($fakeProfile->getAddresses() as $address) {
            $addressHasing[] = $addressHashGenerator->generate($address, $profileId, $arrayHasing);
        }
        $this->assertNotEmpty($addressHasing);
        $this->assertIsString($addressHasing[0]);

        $emailHashGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($fakeProfile->getEmails() as $email) {
            $emailHasing[] = $emailHashGenerator->generate($email, $profileId, $arrayHasing);
        }
        $this->assertNotEmpty($emailHasing);
        $this->assertIsString($emailHasing[0]);

        $usernameHashGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        foreach ($fakeProfile->getUsernames() as $username) {
            $usernameHasing[] = $usernameHashGenerator->generate($username, $profileId, $arrayHasing);
        }
        $this->assertNotEmpty($usernameHasing);
        $this->assertIsString($usernameHasing[0]);

        $educationHashGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        foreach ($fakeProfile->getEducations() as $education) {
            $educationHasing[] = $educationHashGenerator->generate($education, $profileId, $arrayHasing);
        }
        $this->assertNotEmpty($educationHasing);
        $this->assertIsString($educationHasing[0]);

        $phoneHashGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        foreach ($fakeProfile->getPhones() as $phone) {
            $phoneHasing[] = $phoneHashGenerator->generate($phone,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($phoneHasing);
        $this->assertIsString($phoneHasing[0]);

        $criminalRecordHashGenerator = $this->di->make(IProfileCriminalRecordHashGenerator::class);
        foreach ($fakeProfile->getCriminalRecords() as $criminalRecord) {
            $criminalRecordHasing[] = $criminalRecordHashGenerator->generate($criminalRecord,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($criminalRecordHasing);
        $this->assertIsString($criminalRecordHasing[0]);

        $imageHashGenerator = $this->di->make(IProfileImageHashGenerator::class);
        foreach ($fakeProfile->getImages() as $image) {
            $imageHasing[] = $imageHashGenerator->generate($image,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($imageHasing);
        $this->assertIsString($imageHasing[0]);

        $jobHashGenerator = $this->di->make(IProfileJobHashGenerator::class);
        foreach ($fakeProfile->getJobs() as $job) {
            $jobHasing[] = $jobHashGenerator->generate($job,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($jobHasing);
        $this->assertIsString($jobHasing[0]);

        $languageHashGenerator = $this->di->make(IProfileLanguageHashGenerator::class);
        foreach ($fakeProfile->getLanguages() as $language) {
            $languageHasing[] = $languageHashGenerator->generate($language,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($languageHasing);
        $this->assertIsString($languageHasing[0]);

        $metaDataHashGenerator = $this->di->make(IProfileMetaDataHashGenerator::class);
        foreach ($fakeProfile->getMetaData() as $metaData) {
            $metaDataHasing[] = $metaDataHashGenerator->generate($metaData,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($metaDataHasing);
        $this->assertIsString($metaDataHasing[0]);

        $nameHashGenerator = $this->di->make(IProfileNameHashGenerator::class);
        foreach ($fakeProfile->getNames() as $name) {
            $nameHasing[] = $nameHashGenerator->generate($name,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($nameHasing);
        $this->assertIsString($nameHasing[0]);

        $relationsHashGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        foreach ($fakeProfile->getRelationships() as $relations) {
            $relationsHasing[] = $relationsHashGenerator->generate($relations,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($relationsHasing);
        $this->assertIsString($relationsHasing[0]);

        $skillHashGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        foreach ($fakeProfile->getSkills() as $skill) {
            $skillHasing[] = $skillHashGenerator->generate($skill,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($skillHasing);
        $this->assertIsString($skillHasing[0]);

        $socialProfileHashGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        foreach ($fakeProfile->getSocialProfiles() as $socialProfile) {
            $socialProfileHasing[] = $socialProfileHashGenerator->generate($socialProfile,$profileId, $arrayHasing);
        }
        $this->assertNotEmpty($socialProfileHasing);
        $this->assertIsString($socialProfileHasing[0]);

        $profileHashGenerator = $this->di->make(IProfileHashGenerator::class);
        $profileHasing = $profileHashGenerator->generate($fakeProfile->getProfile(),$arrayHasing);
        $this->assertNotEmpty($profileHasing);
        $this->assertIsString($profileHasing[0]);
    }

    public function testAddressHashingWithDifferentProfiles(){
        $dummyProfilesData = $this->generateBulkDummyData();
        $fakeProfileOne = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $fakeProfileTwo = $this->createProfile->input('profile', $dummyProfilesData[1])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileIdOne = $fakeProfileOne->getProfile()->getProfileId();
        $profileIdTwo = $fakeProfileTwo->getProfile()->getProfileId();
        $addressHasingOne = $addressHashGenerator->generate($fakeProfileOne->getAddresses()[0], $profileIdOne, $arrayHasing);
        $addressHasingTwo = $addressHashGenerator->generate($fakeProfileTwo->getAddresses()[0], $profileIdTwo, $arrayHasing);
        $this->assertIsString($addressHasingOne);
        $this->assertIsString($addressHasingTwo);
        $this->assertNotEquals($addressHasingOne,$addressHasingTwo);
    }

    public function testAddressHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $address = $fakeProfile->getAddresses()[0];
        $addressHasingOne = $addressHashGenerator->generate($address, $profileId, $arrayHasing);
        $address->setValidSince(Carbon::now());
        $addressHasingTwo = $addressHashGenerator->generate($address, $profileId, $arrayHasing);
        $this->assertIsString($addressHasingOne);
        $this->assertEquals($addressHasingOne,$addressHasingTwo);
    }

    public function testEducationHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $educationHashGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $education = $fakeProfile->getEducations()[0];
        $educationHasingOne = $educationHashGenerator->generate($education, $profileId, $arrayHasing);
        $education->setValidSince(Carbon::now());
        $educationHasingTwo = $educationHashGenerator->generate($education, $profileId, $arrayHasing);
        $this->assertIsString($educationHasingOne);
        $this->assertEquals($educationHasingOne,$educationHasingTwo);
    }

    public function testEducationHashingWithSameProfileWithDifferentFromAndToDate(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $educationHashGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $education = $fakeProfile->getEducations()[0];
        $educationHasingOne = $educationHashGenerator->generate($education, $profileId, $arrayHasing);
        $education->setFrom(Carbon::now());
        $education->setTo(Carbon::now());
        $educationHasingTwo = $educationHashGenerator->generate($education, $profileId, $arrayHasing);
        $this->assertIsString($educationHasingOne);
        $this->assertEquals($educationHasingOne,$educationHasingTwo);
    }

    public function testEmailHashingWithSameProfileWithDifferentValidSinceAndEspDomain(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $emailHashGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $email = $fakeProfile->getEmails()[0];
        $emailHasingOne = $emailHashGenerator->generate($email, $profileId, $arrayHasing);
        $email->setValidSince(Carbon::now());
        $email->setEspDomain('jawabkom');
        $emailHasingTwo = $emailHashGenerator->generate($email, $profileId, $arrayHasing);
        $this->assertIsString($emailHasingOne);
        $this->assertEquals($emailHasingOne,$emailHasingTwo);
    }

    public function testImageHashingWithSameProfileWithDifferentValidSinceAndLocalPath(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $imageHashGenerator = $this->di->make(IProfileImageHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $image = $fakeProfile->getImages()[0];
        $imageHasingOne = $imageHashGenerator->generate($image, $profileId, $arrayHasing);
        $image->setValidSince(Carbon::now());
        $image->setLocalPath($this->faker->imageUrl);
        $imageHasingTwo = $imageHashGenerator->generate($image, $profileId, $arrayHasing);
        $this->assertIsString($imageHasingOne);
        $this->assertEquals($imageHasingOne,$imageHasingTwo);
    }

    public function testJobHashingWithSameProfileWithDifferentValidSinceAndFromAndToDate(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $jobHashGenerator = $this->di->make(IProfileJobHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $job = $fakeProfile->getJobs()[0];
        $jobHasingOne = $jobHashGenerator->generate($job, $profileId, $arrayHasing);
        $job->setValidSince(Carbon::now());
        $job->setFrom(Carbon::now()->subYears(10));
        $job->setTo(Carbon::now()->addYears(5));
        $jobHasingTwo = $jobHashGenerator->generate($job, $profileId, $arrayHasing);
        $this->assertIsString($jobHasingOne);
        $this->assertEquals($jobHasingOne,$jobHasingTwo);
    }

    public function testNameHashingWithSameProfileWithDisplay(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $nameHashGenerator = $this->di->make(IProfileNameHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $name = $fakeProfile->getNames()[0];
        $nameHasingOne = $nameHashGenerator->generate($name, $profileId, $arrayHasing);
        $name->setDisplay('test name display');
        $nameHasingTwo = $nameHashGenerator->generate($name, $profileId, $arrayHasing);
        $this->assertIsString($nameHasingOne);
        $this->assertEquals($nameHasingOne,$nameHasingTwo);
    }

    public function testPhoneHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $phoneHashGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $phone = $fakeProfile->getPhones()[0];
        $phoneHasingOne = $phoneHashGenerator->generate($phone, $profileId, $arrayHasing);
        $phone->setValidSince(Carbon::now());
        $phoneHasingTwo = $phoneHashGenerator->generate($phone, $profileId, $arrayHasing);
        $this->assertIsString($phoneHasingOne);
        $this
            ->assertEquals($phoneHasingOne,$phoneHasingTwo);
    }

    public function testRelationsHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $relationsHashGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $relations = $fakeProfile->getRelationships()[0];
        $relationsHasingOne = $relationsHashGenerator->generate($relations, $profileId, $arrayHasing);
        $relations->setValidSince(Carbon::now());
        $relationsHasingTwo = $relationsHashGenerator->generate($relations, $profileId, $arrayHasing);
        $this->assertIsString($relationsHasingOne);
        $this->assertEquals($relationsHasingOne,$relationsHasingTwo);
    }

    public function testSkillHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $skillHashGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $skill = $fakeProfile->getSkills()[0];
        $skillHasingOne = $skillHashGenerator->generate($skill, $profileId, $arrayHasing);
        $skill->setValidSince(Carbon::now());
        $skillHasingTwo = $skillHashGenerator->generate($skill, $profileId, $arrayHasing);
        $this->assertIsString($skillHasingOne);
        $this->assertEquals($skillHasingOne,$skillHasingTwo);
    }

    public function testSocialProfileHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $socialProfileHashGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $socialProfile = $fakeProfile->getSocialProfiles()[0];
        $socialProfileHasingOne = $socialProfileHashGenerator->generate($socialProfile, $profileId, $arrayHasing);
        $socialProfile->setValidSince(Carbon::now());
        $socialProfileHasingTwo = $socialProfileHashGenerator->generate($socialProfile, $profileId, $arrayHasing);
        $this->assertIsString($socialProfileHasingOne);
        $this->assertEquals($socialProfileHasingOne,$socialProfileHasingTwo);
    }

    public function testUsernameHashingWithSameProfileWithDifferentValidSince(){
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $usernameHashGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId   = $fakeProfile->getProfile()->getProfileId();
        $username = $fakeProfile->getUsernames()[0];
        $usernameHasingOne = $usernameHashGenerator->generate($username, $profileId, $arrayHasing);
        $username->setValidSince(Carbon::now());
        $usernameHasingTwo = $usernameHashGenerator->generate($username, $profileId, $arrayHasing);
        $this->assertIsString($usernameHasingOne);
        $this->assertEquals($usernameHasingOne,$usernameHasingTwo);
    }

}