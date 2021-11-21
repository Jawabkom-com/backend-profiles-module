<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CompositeMergeLibraryTest extends AbstractTestCase
{
    use DummyTrait;

    private \Faker\Generator $faker;
    private IDependencyInjector $di;
    private IProfileRepository $profileRepository;
    private IProfileComposite $profileComposite;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->profileRepository = $this->di->make(IProfileRepository::class);
        $this->profileComposite = $this->di->make(IProfileComposite::class);
        $this->faker = Factory::create();
    }

    public function testCompositeMerge()
    {
        $composite1 = $this->generateFirstComposite();
        $composite2 = $this->generateSecondComposite();
        $compositeMerge = $this->di->make(ICompositesMerge::class);
        $newComposite = $compositeMerge->merge(array($composite1, $composite2));
        $this->assertInstanceOf(IProfileComposite::class,$newComposite);
        $this->assertCount(3,$newComposite->getEmails());
        $this->assertCount(1,$newComposite->getUsernames());
        $this->assertCount(1,$newComposite->getAddresses());
        $this->assertCount(1,$newComposite->getNames());
        $this->assertCount(1,$newComposite->getPhones());
        $this->assertCount(1,$newComposite->getCriminalRecords());
        $this->assertCount(1,$newComposite->getEducations());
        $this->assertCount(1,$newComposite->getImages());
        $this->assertCount(1,$newComposite->getLanguages());
        $this->assertCount(1,$newComposite->getJobs());
        $this->assertCount(1,$newComposite->getMetaData());
        $this->assertCount(1,$newComposite->getRelationships());
        $this->assertCount(1,$newComposite->getSkills());
        $this->assertCount(1,$newComposite->getSocialProfiles());
    }
    public function testCompositeMergeWithProfileId()
    {
        $composite1 = $this->generateFirstComposite();
        $composite2 = $this->generateSecondComposite();
        $compositeMerge = $this->di->make(ICompositesMerge::class);
        $newComposite = $compositeMerge->merge(array($composite1, $composite2));
        $this->assertInstanceOf(IProfileComposite::class,$newComposite);
        $this->assertNotEmpty($newComposite->getProfile()->getProfileId());
        $this->assertCount(3,$newComposite->getEmails());
        $this->assertCount(1,$newComposite->getUsernames());
        $this->assertCount(1,$newComposite->getAddresses());
        $this->assertCount(1,$newComposite->getNames());
        $this->assertCount(1,$newComposite->getPhones());
        $this->assertCount(1,$newComposite->getCriminalRecords());
        $this->assertCount(1,$newComposite->getEducations());
        $this->assertCount(1,$newComposite->getImages());
        $this->assertCount(1,$newComposite->getLanguages());
        $this->assertCount(1,$newComposite->getJobs());
        $this->assertCount(1,$newComposite->getMetaData());
        $this->assertCount(1,$newComposite->getRelationships());
        $this->assertCount(1,$newComposite->getSkills());
        $this->assertCount(1,$newComposite->getSocialProfiles());
    }


    public function generateFirstComposite()
    {
        $dummyBasicData = $this->dummyBasicProfileData();
        $profileRepository= $this->di->make(IProfileRepository::class);
        $uuidFactory = $this->di->make(IProfileUuidFactory::class);
        $profileEntity = $profileRepository->createEntity();
        $profileEntity->setProfileId($uuidFactory->generate());
        $profileEntity->setGender($dummyBasicData['gender'] ?? null);
        $profileEntity->setDataSource($dummyBasicData['data_source'] ?? null);
        $profileEntity->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profileEntity->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);
        $composite = $this->di->make(IProfileComposite::class);
        $composite->setProfile($profileEntity);
        $this->generateEmailEntity($composite);
        $this->generateAddressEntity($composite);
        $this->generatePhonesEntity($composite);
        $this->generateCriminalRecordsEntity($composite);
        $this->generateImagesEntity($composite);
        $this->generateJobEntity($composite);
        $this->generateRelationshipsEntity($composite);
        $this->generateSkillsEntity($composite);
        return $composite;
    }

    public function generateSecondComposite()
    {
        $dummyBasicData = $this->dummyBasicProfileData();
        $profileRepository= $this->di->make(IProfileRepository::class);
        $profileEntity = $profileRepository->createEntity();
        $profileEntity->setGender($dummyBasicData['gender'] ?? null);
        $profileEntity->setDataSource($dummyBasicData['data_source'] ?? null);
        $profileEntity->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profileEntity->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);

        $composite = $this->di->make(IProfileComposite::class);
        $composite->setProfile($profileEntity);
        $this->generateEmailEntity($composite);
        $this->generateUsernameEntity($composite);
        $this->generateNamesEntity($composite);
        $this->generateEducationsEntity($composite);
        $this->generateLanguageEntity($composite);
        $this->generateMetaDataEntity($composite);
        $this->generateSocialProfilesEntity($composite);
        return $composite;
    }

    public function generateEmailEntity(&$composite)
    {
        $emailRepository = $this->di->make(IProfileEmailRepository::class);
        $dummyEmailData = [
            $this->dummyEmailsData(),
            [
                'valid_since'=>'1997-09-03',
                'email'=> 'xx@example.org',
                'type'=>'personal',
            ]
        ];
        foreach ($dummyEmailData as $emailData){
            $newEntity = $emailRepository->createEntity();
            $newEntity->setValidSince(!empty($emailData['valid_since']) ? new \DateTime($emailData['valid_since']) : null);
            $newEntity->setEmail($emailData['email'] ?? null);
            $newEntity->setEspDomain($emailData['esp_domain'] ?? null);
            $newEntity->setType($emailData['type'] ?? null);
            $composite->addEmail($newEntity);
        }
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $emailHashingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($composite->getEmails() as $emailObj) {
            $emailObj->setHash($emailHashingGenerator->generate($emailObj, $arrayHashing));
        }
    }

    public function generateUsernameEntity(&$composite)
    {
        $usernameRepository = $this->di->make(IProfileUsernameRepository::class);
        $dummyUsernameData =  $this->dummyUsernamesData();
            $newEntity = $usernameRepository->createEntity();
            $newEntity->setValidSince(!empty($dummyUsernameData['valid_since']) ? new \DateTime($dummyUsernameData['valid_since']) : null);
            $newEntity->setUsername($dummyUsernameData['username']);
            $composite->addUsername($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $usernameHashingGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        foreach ($composite->getUsernames() as $usernameObj) {
            $usernameObj->setHash($usernameHashingGenerator->generate($usernameObj, $arrayHashing));
        }
    }

    public function generateAddressEntity(&$composite)
    {
        $addressRepository = $this->di->make(IProfileAddressRepository::class);
        $dummyAddressData =  $this->dummyAddressData();
        $newEntity = $addressRepository->createEntity();
        $newEntity->setValidSince(!empty($dummyAddressData['valid_since']) ? new \DateTime($dummyAddressData['valid_since']) : null);
        $newEntity->setCountry($dummyAddressData['country']);
        $newEntity->setState($dummyAddressData['state']);
        $newEntity->setCity($dummyAddressData['city']);
        $newEntity->setZip($dummyAddressData['zip']);
        $newEntity->setStreet($dummyAddressData['street']);
        $newEntity->setBuildingNumber($dummyAddressData['building_number']);
        $newEntity->setDisplay($dummyAddressData['display']);
        $composite->addAddress($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $addressHashingGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        foreach ($composite->getAddresses() as $addressObj) {
            $addressObj->setHash($addressHashingGenerator->generate($addressObj, $arrayHashing));
        }
    }

    public function generateNamesEntity(&$composite)
    {
        $nameRepository = $this->di->make(IProfileNameRepository::class);
        $dummyNameData =  $this->dummyNamesData();
        $newEntity = $nameRepository->createEntity();
        $newEntity->setFirst($dummyNameData['first'] ?? null);
        $newEntity->setMiddle($dummyNameData['middle'] ?? null);
        $newEntity->setLast($dummyNameData['last'] ?? null);
        $newEntity->setPrefix($dummyNameData['prefix'] ?? null);
        $composite->addName($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $nameHashingGenerator = $this->di->make(IProfileNameHashGenerator::class);
        foreach ($composite->getNames() as $nameObj) {
            $nameObj->setHash($nameHashingGenerator->generate($nameObj, $arrayHashing));
        }
    }

    public function generatePhonesEntity(&$composite)
    {
        $phoneRepository = $this->di->make(IProfilePhoneRepository::class);
        $dummyPhoneData =  $this->dummyPhoneData();
        $newEntity = $phoneRepository->createEntity();
        $newEntity->setValidSince(!empty($dummyPhoneData['valid_since']) ? new \DateTime($dummyPhoneData['valid_since']) : null);
        $newEntity->setType($dummyPhoneData['type']);
        $newEntity->setDoNotCallFlag($dummyPhoneData['do_not_call_flag']);
        $newEntity->setCountryCode($dummyPhoneData['country_code']);
        $newEntity->setOriginalNumber($dummyPhoneData['original_number']);
        $newEntity->setRiskyPhone($dummyPhoneData['risky_phone']);
        $newEntity->setDisposablePhone($dummyPhoneData['disposable_phone']);
        $newEntity->setCarrier($dummyPhoneData['carrier']);
        $newEntity->setPurpose($dummyPhoneData['purpose']);
        $newEntity->setIndustry($dummyPhoneData['industry']);
        $newEntity->setPossibleCountries($dummyPhoneData['possible_countries']);
        $composite->addPhone($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $phoneHashingGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        foreach ($composite->getPhones() as $phoneObj) {
            $phoneObj->setHash($phoneHashingGenerator->generate($phoneObj, $arrayHashing));
        }
    }

    public function generateCriminalRecordsEntity(&$composite)
    {
        $criminalRecordRepository = $this->di->make(IProfileCriminalRecordRepository::class);
        $dummyCriminalRecordData =  $this->dummyCriminalRecordsData();
        $newEntity = $criminalRecordRepository->createEntity();
        $newEntity->setCaseNumber($dummyCriminalRecordData['case_number']);
        $newEntity->setCaseType($dummyCriminalRecordData['case_type']);
        $newEntity->setCaseYear($dummyCriminalRecordData['case_year']);
        $newEntity->setCaseStatus($dummyCriminalRecordData['case_status']);
        $newEntity->setDisplay($dummyCriminalRecordData['display']);
        $composite->addCriminalRecord($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $criminalRecordHashingGenerator = $this->di->make(IProfileCriminalRecordHashGenerator::class);
        foreach ($composite->getCriminalRecords() as $criminalRecordObj) {
            $criminalRecordObj->setHash($criminalRecordHashingGenerator->generate($criminalRecordObj, $arrayHashing));
        }
    }

    public function generateEducationsEntity(&$composite)
    {
        $educationRepository = $this->di->make(IProfileEducationRepository::class);
        $dummyEducationData =  $this->dummyEducationsData();
        $newEntity = $educationRepository->createEntity();
        $newEntity->setValidSince(!empty($dummyEducationData['valid_since']) ? new \DateTime($dummyEducationData['valid_since']) : null);
        $newEntity->setFrom(!empty($dummyEducationData['from']) ? new \DateTime($dummyEducationData['from']) : null);
        $newEntity->setTo(!empty($dummyEducationData['to']) ? new \DateTime($dummyEducationData['to']) : null);
        $newEntity->setSchool($dummyEducationData['school']);
        $newEntity->setDegree($dummyEducationData['degree']);
        $newEntity->setMajor($dummyEducationData['major']);
        $composite->addEducation($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $educationHashingGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        foreach ($composite->getEducations() as $educationObj) {
            $educationObj->setHash($educationHashingGenerator->generate($educationObj, $arrayHashing));
        }
    }

    public function generateImagesEntity(&$composite)
    {
        $imageRepository = $this->di->make(IProfileImageRepository::class);
        $dummyImageData =  $this->dummyImagesData();
        $newEntity = $imageRepository->createEntity();
        $newEntity->setOriginalUrl($dummyImageData['original_url']);
        $newEntity->setValidSince(!empty($dummyImageData['valid_since']) ? new \DateTime($dummyImageData['valid_since']) : null);
        $composite->addImage($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $imageHashingGenerator = $this->di->make(IProfileImageHashGenerator::class);
        foreach ($composite->getImages() as $imageObj) {
            $imageObj->setHash($imageHashingGenerator->generate($imageObj, $arrayHashing));
        }
    }

    public function generateJobEntity(&$composite)
    {
        $jobRepository = $this->di->make(IProfileJobRepository::class);
        $dummyJobData =  $this->dummyjobsData();
        $newEntity = $jobRepository->createEntity();
        $newEntity->setValidSince(!empty($dummyJobData['valid_since']) ? new \DateTime($dummyJobData['valid_since']) : null);
        $newEntity->setFrom(!empty($dummyJobData['from']) ? new \DateTime($dummyJobData['from']) : null);
        $newEntity->setTo(!empty($dummyJobData['to']) ? new \DateTime($dummyJobData['to']) : null);
        $newEntity->setTitle($dummyJobData['title']);
        $newEntity->setOrganization($dummyJobData['organization']);
        $newEntity->setIndustry($dummyJobData['industry']);
        $composite->addJob($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $jobHashingGenerator = $this->di->make(IProfileJobHashGenerator::class);
        foreach ($composite->getJobs() as $jobObj) {
            $jobObj->setHash($jobHashingGenerator->generate($jobObj, $arrayHashing));
        }
    }

    public function generateLanguageEntity(&$composite)
    {
        $languageRepository = $this->di->make(IProfileLanguageRepository::class);
        $dummyLanguageData =  $this->dummyLanguagesData();
        $newEntity = $languageRepository->createEntity();
        $newEntity->setLanguage($dummyLanguageData['language']);
        $newEntity->setCountry($dummyLanguageData['country']);
        $composite->addLanguage($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $languageHashingGenerator = $this->di->make(IProfileLanguageHashGenerator::class);
        foreach ($composite->getLanguages() as $languageObj) {
            $languageObj->setHash($languageHashingGenerator->generate($languageObj, $arrayHashing));
        }
    }

    public function generateMetaDataEntity(&$composite)
    {
        $metaDataRepository = $this->di->make(IProfileMetaDataRepository::class);
        $dummyMetaData =  $this->dummyMetaData();
        $newEntity = $metaDataRepository->createEntity();
        $newEntity->setMetaKey($dummyMetaData['meta_key']);
        $newEntity->setMetaValue($dummyMetaData['meta_value']);
        $composite->addMetaData($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $metaDataHashingGenerator = $this->di->make(IProfileMetaDataHashGenerator::class);
        foreach ($composite->getMetaData() as $metaDataObj) {
            $metaDataObj->setHash($metaDataHashingGenerator->generate($metaDataObj, $arrayHashing));
        }
    }

    public function generateRelationshipsEntity(&$composite)
    {
        $relationshipRepository = $this->di->make(IProfileRelationshipRepository::class);
        $dummyRelationshipData =  $this->dummyRelationshipsData();
        $newEntity = $relationshipRepository->createEntity();
        $newEntity->setValidSince(!empty($dummyRelationshipData['valid_since']) ? new \DateTime($dummyRelationshipData['valid_since']) : null);
        $newEntity->setType($dummyRelationshipData['type']);
        $newEntity->setFirstName($dummyRelationshipData['first_name']);
        $newEntity->setLastName($dummyRelationshipData['last_name']);
        $composite->addRelationship($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $relationshipHashingGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        foreach ($composite->getRelationships() as $relationObj) {
            $relationObj->setHash($relationshipHashingGenerator->generate($relationObj, $arrayHashing));
        }
    }

    public function generateSkillsEntity(&$composite)
    {
        $skillRepository = $this->di->make(IProfileSkillRepository::class);
        $dummySkillData =  $this->dummySkillsData();
        $newEntity = $skillRepository->createEntity();
        $newEntity->setValidSince(!empty($dummySkillData['valid_since']) ? new \DateTime($dummySkillData['valid_since']) : null);
        $newEntity->setLevel($dummySkillData['level']);
        $newEntity->setSkill($dummySkillData['skill']);
        $composite->addSkill($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $skillHashingGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        foreach ($composite->getSkills() as $skillObj) {
            $skillObj->setHash($skillHashingGenerator->generate($skillObj, $arrayHashing));
        }
    }

    public function generateSocialProfilesEntity(&$composite)
    {
        $socialProfileRepository = $this->di->make(IProfileSocialProfileRepository::class);
        $dummySocialProfileData =  $this->dummysSocialProfilesData();
        $newEntity = $socialProfileRepository->createEntity();
        $newEntity->setValidSince(!empty($dummySocialProfileData['valid_since']) ? new \DateTime($dummySocialProfileData['valid_since']) : null);
        $newEntity->setUrl($dummySocialProfileData['url']);
        $newEntity->setType($dummySocialProfileData['type']);
        $newEntity->setUsername($dummySocialProfileData['username']);
        $newEntity->setAccountId($dummySocialProfileData['account_id']);
        $composite->addSocialProfile($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $socialProfileHashingGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        foreach ($composite->getSocialProfiles() as $socialProfileObj) {
            $socialProfileObj->setHash($socialProfileHashingGenerator->generate($socialProfileObj, $arrayHashing));
        }
    }

}
