<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\BasicArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
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
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Trait\ValidationInputsTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    use ProfileAddEditMethods;
    use ValidationInputsTrait;

    protected IProfileRepository $repository;
    protected array $profileStructure = [
        'phones',
        'addresses',
        'usernames',
        'emails',
        'relationships',
        'skills',
        'images',
        'languages',
        'jobs',
        'educations',
        'social_profiles',
        'criminal_records',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'data_source',
        'meta_data',
    ];
    private IArrayHashing $arrayHashing;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository, IArrayHashing $arrayHashing)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->arrayHashing = $arrayHashing;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        //validate inputs
        $this->validateInputs();
        //create && save profile
        $createNewProfileRecord = $this->createNewProfileRecord($this->getInput('profile'));
        $this->setOutput('profile', $createNewProfileRecord);
        return $this;
    }

    //
    // LEVEL 1
    //
    protected function validateInputs()
    {
        $profile = $this->getInput('profile');
        $this->validateProfileInputs($profile);
        $this->validateNameInputs($profile['names'] ?? []);
        $this->validatePhoneInputs($profile['phones'] ?? []);
        $this->validateAddressInputs($profile['addresses'] ?? []);
        $this->validateLanguageInputs($profile['languages'] ?? []);
        $this->validateUsernameInputs($profile['usernames'] ?? []);
        $this->validateEmailInputs($profile['emails'] ?? []);
        $this->validateCriminalRecordsInputs($profile['criminal_records'] ?? []);
        $this->validateEducationsInputs($profile['educations'] ?? []);
        $this->validateImagesInputs($profile['images'] ?? []);
        $this->validateJobsInputs($profile['jobs'] ?? []);
        $this->validateRelationshipsInputs($profile['relationships'] ?? []);
        $this->validateSkillsInputs($profile['skills'] ?? []);
        $this->validateSocialProfilesInputs($profile['social_profiles'] ?? []);
        $this->validateMetaDataInputs($profile['meta_data'] ?? []);
    }

    protected function createNewProfileRecord($profileInputs): IProfileEntity
    {
        $profileEntity = $this->repository->createEntity();
        $this->fillProfileEntity($profileEntity, $profileInputs, true);
        foreach ($profileInputs as $profilePartKey => $profilePartInput) {
            $processingMethodName = "process" . str_replace('_', '', ucwords($profilePartKey, '_'));
            if (method_exists($this, $processingMethodName)) {
                $this->$processingMethodName($profileEntity, $profilePartInput);
            }
        }

        $this->setProfileHash($profileEntity);
        // todo: make sure there is no other profiles with the same hash
        $this->repository->saveEntity($profileEntity);
        return $profileEntity;
    }

    //
    // LEVEL 2
    //
    protected function processNames(IProfileEntity $profileEntity, array $names)
    {
        $repository = $this->di->make(IProfileNameRepository::class);
        foreach ($names as $name) {
            $nameObj = $repository->createEntity();
            $this->fillNameEntity($profileEntity, $nameObj, $name);
            $profileEntity->addName($nameObj);
        }
    }

    protected function processAddresses(IProfileEntity $profileEntity, array $addresses)
    {
        $repository = $this->di->make(IProfileAddressRepository::class);
        foreach ($addresses as $address) {
            $addressObj = $repository->createEntity();
            $this->fillAddressEntity($profileEntity, $addressObj, $address);
            $profileEntity->addAddress($addressObj);
        }
    }

    protected function processCriminalRecords(IProfileEntity $profileEntity, array $criminalRecords)
    {
        $repository = $this->di->make(IProfileCriminalRecordRepository::class);
        foreach ($criminalRecords as $criminalRecord) {
            $criminalRecordObj = $repository->createEntity();
            $this->fillCriminalRecordEntity($profileEntity, $criminalRecordObj, $criminalRecord);
            $profileEntity->addCriminalRecord($criminalRecordObj);
        }
    }

    protected function processEducations(IProfileEntity $profileEntity, array $educations)
    {
        $repository = $this->di->make(IProfileEducationRepository::class);
        foreach ($educations as $education) {
            $educationObj = $repository->createEntity();
            $this->fillEducationEntity($profileEntity, $educationObj, $education);
            $profileEntity->addEducation($educationObj);
        }
    }

    protected function processEmails(IProfileEntity $profileEntity, array $emails)
    {
        $repository = $this->di->make(IProfileEmailRepository::class);
        foreach ($emails as $email) {
            $emailObj = $repository->createEntity();
            $this->fillEmailEntity($profileEntity, $emailObj, $email);
            $profileEntity->addEmail($emailObj);
        }
    }

    protected function processImages(IProfileEntity $profileEntity, array $images)
    {
        $repository = $this->di->make(IProfileImageRepository::class);
        foreach ($images as $image) {
            $imageObj = $repository->createEntity();
            $this->fillImageEntity($profileEntity, $imageObj, $image);
            $profileEntity->addImage($imageObj);
        }
    }

    protected function processJobs(IProfileEntity $profileEntity, array $jobs)
    {
        $repository = $this->di->make(IProfileJobRepository::class);
        foreach ($jobs as $job) {
            $jobObj = $repository->createEntity();
            $this->fillJobEntity($profileEntity, $jobObj, $job);
            $profileEntity->addJob($jobObj);
        }
    }

    protected function processLanguages(IProfileEntity $profileEntity, array $languages)
    {
        $repository = $this->di->make(IProfileLanguageRepository::class);
        foreach ($languages as $language) {
            $languageObj = $repository->createEntity();
            $this->fillLanguageEntity($profileEntity, $languageObj, $language);
            $profileEntity->addLanguage($languageObj);
        }
    }

    protected function processPhones(IProfileEntity $profileEntity, array $phones)
    {
        $repository = $this->di->make(IProfilePhoneRepository::class);
        foreach ($phones as $phone) {
            $phoneObj = $repository->createEntity();
            $this->fillPhoneEntity($profileEntity, $phoneObj, $phone);
            $profileEntity->addPhone($phoneObj);
        }
    }

    protected function processRelationships(IProfileEntity $profileEntity, array $relationships)
    {
        $repository = $this->di->make(IProfileRelationshipRepository::class);
        foreach ($relationships as $relationship) {
            $relationshipObj = $repository->createEntity();
            $this->fillRelationshipEntity($profileEntity, $relationshipObj, $relationship);
            $profileEntity->addRelationship($relationshipObj);
        }
    }

    protected function processSkills(IProfileEntity $profileEntity, array $skills)
    {
        $repository = $this->di->make(IProfileSkillRepository::class);
        foreach ($skills as $skill) {
            $skillObj = $repository->createEntity();
            $this->fillSkillEntity($profileEntity, $skillObj, $skill);
            $profileEntity->addSkill($skillObj);
        }
    }

    protected function processSocialProfiles(IProfileEntity $profileEntity, array $socialProfiles)
    {
        $repository = $this->di->make(IProfileSocialProfileRepository::class);
        foreach ($socialProfiles as $socialProfile) {
            $socialProfileObj = $repository->createEntity();
            $this->fillSocialProfileEntity($profileEntity, $socialProfileObj, $socialProfile);
            $profileEntity->addSocialProfile($socialProfileObj);
        }
    }

    protected function processUsernames(IProfileEntity $profileEntity, array $usernames)
    {
        $repository = $this->di->make(IProfileUsernameRepository::class);
        foreach ($usernames as $username) {
            $usernameObj = $repository->createEntity();
            $this->fillUsernameEntity($profileEntity, $usernameObj, $username);
            $profileEntity->addUsername($usernameObj);
        }
    }
    protected function processMetaData(IProfileEntity $profileEntity, array $meta)
    {
        $repository = $this->di->make(IProfileMetaDataRepository::class);
        foreach ($meta as $value) {
            $metaObj = $repository->createEntity();
            $this->fillMetaDataEntity($profileEntity, $metaObj, $value);
            $profileEntity->addMetaData($metaObj);
        }
    }

    protected function setProfileHash(IProfileEntity $profileEntity)
    {
        $profileToArray = $profileEntity->toArray();
        unset($profileToArray['hash']);
        $profileEntity->setHash($this->arrayHashing->hash($profileToArray));
    }

}
