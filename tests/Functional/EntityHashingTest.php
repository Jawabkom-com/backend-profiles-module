<?php

namespace Functional;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCriminalRecordHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEducationHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileImageHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileJobHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileLanguageHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileMetaDataHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileNameHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfilePhoneHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileRelationsHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileSkillHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileSocialProfileHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileUsernameHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;

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
    }

}