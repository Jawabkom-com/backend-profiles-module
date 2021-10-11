<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
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
        'data_source'
    ];

    public function __construct(IDependencyInjector $di, IProfileRepository $repository)
    {
        parent::__construct($di);
        $this->repository = $repository;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        //validate inputs
        $this->validateInputs();
        //create && save profile
        $createNewProfileRecord = $this->createNewProfileRecord( $this->getInput('profile'));
        $this->setOutput('profile',$createNewProfileRecord);
        return $this;
    }

    //
    // LEVEL 1
    //
    protected function validateInputs()
    {
         $profile = $this->getInput('profile');
         $this->validateProfileInputs($profile);

         $this->validateNameInputs($profile['names']??[]);
         $this->validatePhoneInputs($profile['phones']??[]);
         $this->validateAddressInputs($profile['addresses']??[]);
         $this->validateUsernameInputs($profile['usernames']??[]);
         $this->validateEmailInputs($profile['emails']??[]);
         $this->validateCriminalRecordsInputs($profile['criminal_records']??[]);
         $this->validateEducationsInputs($profile['educations']??[]);
         $this->validateImagesInputs($profile['images']??[]);
         $this->validateJobsInputs($profile['jobs']??[]);
         $this->validateRelationshipsInputs($profile['relationships']??[]);
         $this->validateSkillsInputs($profile['skills']??[]);
         $this->validateSocialProfilesInputs($profile['social_profiles']??[]);
    }

    protected function createNewProfileRecord($profileInputs): IProfileEntity
    {
        $profileEntity = $this->repository->createEntity();
        $this->fillProfileEntity($profileEntity, $profileInputs, true);
        foreach ($profileInputs as $profilePartKey => $profilePartInput) {
            $processingMethodName = "process" . ucfirst($profilePartKey);
            if(method_exists($this, $processingMethodName)){
                $this->$processingMethodName($profileEntity, $profilePartInput);
            }
        }
        $this->repository->saveEntity($profileEntity);
        return $profileEntity;
    }

    //
    // LEVEL 2
    //
    protected function processNames(IProfileEntity $profileEntity, array $names)
    {
        foreach ($names as $name) {
            $nameObj = $this->di->make(IProfileNameEntity::class);
            $this->fillNameEntity($profileEntity, $nameObj, $name);
            $profileEntity->addName($nameObj);
        }
    }

    protected function processAddresses(IProfileEntity $profileEntity, array $addresses)
    {
        foreach ($addresses as $address) {
            $addressObj = $this->di->make(IProfileAddressRepository::class);
            $this->fillAddressEntity($profileEntity,$addressObj,$address);
            $profileEntity->addAddress($addressObj);
        }
    }

    protected function processCriminalRecords(IProfileEntity $profileEntity, array $criminalRecords)
    {
        foreach ($criminalRecords as $criminalRecord) {
            $criminalRecordObj = $this->di->make(IProfileCriminalRecordRepository::class);
            $this->fillCriminalRecordEntity($profileEntity,$criminalRecordObj,$criminalRecord);
            $profileEntity->addCriminalRecord($criminalRecordObj);
        }
    }

    protected function processEducations(IProfileEntity $profileEntity, array $educations)
    {
        foreach ($educations as $education) {
            $educationObj = $this->di->make(IProfileEducationRepository::class);
            $this->fillEducationEntity($profileEntity,$educationObj,$education);
            $profileEntity->addEducation($educationObj);
        }
    }

    protected function processEmails(IProfileEntity $profileEntity, array $emails)
    {
        foreach ($emails as $email) {
            $emailObj = $this->di->make(IProfileEmailRepository::class);
            $this->fillEmailEntity($profileEntity,$emailObj,$email);
            $profileEntity->addEmail($emailObj);
        }
    }

    protected function processImages(IProfileEntity $profileEntity, array $images)
    {
        foreach ($images as $image) {
            $imageObj = $this->di->make(IProfileImageRepository::class);
            $this->fillImageEntity($profileEntity,$imageObj,$image);
            $profileEntity->addImage($imageObj);
        }
    }

    protected function processJobs(IProfileEntity $profileEntity, array $jobs)
    {
        foreach ($jobs as $job) {
            $jobObj = $this->di->make(IProfileJobRepository::class);
            $this->fillJobEntity($profileEntity,$jobObj,$job);
            $profileEntity->addJob($jobObj);
        }
    }

    protected function processLanguages(IProfileEntity $profileEntity, array $languages)
    {
        foreach ($languages as $language) {
            $languageObj = $this->di->make(IProfileLanguageRepository::class);
            $this->fillLanguageEntity($profileEntity,$languageObj,$language);
            $profileEntity->addLanguage($languageObj);
        }
    }

    protected function processPhones(IProfileEntity $profileEntity, array $phones)
    {
        foreach ($phones as $phone) {
            $phoneObj = $this->di->make(IProfilePhoneRepository::class);
            $this->fillPhoneEntity($profileEntity,$phoneObj,$phone);
            $profileEntity->addPhone($phoneObj);
        }
    }

    protected function processRelationships(IProfileEntity $profileEntity, array $relationships)
    {
        foreach ($relationships as $relationship) {
            $relationshipObj = $this->di->make(IProfileRelationshipRepository::class);
            $this->fillRelationshipEntity($profileEntity,$relationshipObj,$relationship);
            $profileEntity->addRelationship($relationshipObj);
        }
    }

    protected function processSkills(IProfileEntity $profileEntity, array $skills)
    {
        foreach ($skills as $skill) {
            $skillObj = $this->di->make(IProfileSkillRepository::class);
            $this->fillSkillEntity($profileEntity,$skillObj,$skill);
            $profileEntity->addSkill($skillObj);
        }
    }

    protected function processSocialProfiles(IProfileEntity $profileEntity, array $socialProfiles)
    {
        foreach ($socialProfiles as $socialProfile) {
            $socialProfileObj = $this->di->make(IProfileSocialProfileEntity::class);
            $this->fillSocialProfileEntity($profileEntity,$socialProfileObj,$socialProfile);
            $profileEntity->addSocialProfile($socialProfileObj);
        }
    }

    protected function processUsernames(IProfileEntity $profileEntity, array $usernames)
    {
        foreach ($usernames as $username) {
            $usernameObj = $this->di->make(IProfileUsernameRepository::class);
            $this->fillUsernameEntity($profileEntity,$usernameObj,$username);
            $profileEntity->addUsername($usernameObj);
        }
    }


}
