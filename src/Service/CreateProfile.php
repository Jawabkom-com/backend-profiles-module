<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;

use Jawabkom\Backend\Module\Profile\Validator\ProfileAddressesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileCriminalRecordsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileEducationsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileEmailsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileImagesInputValidator;

use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Validator\ProfileInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileJobsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileLanguagesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileNamesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfilePhonesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileRelationshipsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileSkillsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileSocialProfilesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileUsernamesInputValidator;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    use ProfileAddEditMethods;

    protected IProfileRepository $repository;
    protected array $profileStructure = ['phones', 'addresses', 'usernames', 'emails', 'relationships', 'skills', 'images', 'languages', 'jobs', 'educations', 'social_profiles', 'criminal_records', 'gender', 'date_of_birth', 'place_of_birth', 'data_source'];
    private ProfileInputValidator $profileInputValidator;
    private ProfileNamesInputValidator $profileNamesInputValidator;
    private ProfileAddressesInputValidator $profileAddressesInputValidator;
    private ProfileCriminalRecordsInputValidator $profileCriminalRecordsInputValidator;
    private ProfileEducationsInputValidator $profileEducationsInputValidator;
    private ProfileEmailsInputValidator $profileEmailsInputValidator;
    private ProfileImagesInputValidator $profileImagesInputValidator;
    private ProfileJobsInputValidator $profileJobsInputValidator;
    private ProfileLanguagesInputValidator $profileLanguagesInputValidator;
    private ProfilePhonesInputValidator $profilePhonesInputValidator;
    private ProfileRelationshipsInputValidator $profileRelationshipsInputValidator;
    private ProfileSkillsInputValidator $profileSkillsInputValidator;
    private ProfileSocialProfilesInputValidator $profileSocialProfilesInputValidator;
    private ProfileUsernamesInputValidator $profileUsernamesInputValidator;

    public function __construct(
        IDependencyInjector $di,
        IProfileRepository $repository,
        ProfileInputValidator $profileInputValidator,
        ProfileNamesInputValidator $profileNamesInputValidator,
        ProfileAddressesInputValidator $profileAddressesInputValidator,
        ProfileCriminalRecordsInputValidator $profileCriminalRecordsInputValidator,
        ProfileEducationsInputValidator $profileEducationsInputValidator,
        ProfileEmailsInputValidator $profileEmailsInputValidator,
        ProfileImagesInputValidator $profileImagesInputValidator,
        ProfileJobsInputValidator $profileJobsInputValidator,
        ProfileLanguagesInputValidator $profileLanguagesInputValidator,
        ProfilePhonesInputValidator $profilePhonesInputValidator,
        ProfileRelationshipsInputValidator $profileRelationshipsInputValidator,
        ProfileSkillsInputValidator $profileSkillsInputValidator,
        ProfileSocialProfilesInputValidator $profileSocialProfilesInputValidator,
        ProfileUsernamesInputValidator $profileUsernamesInputValidator,
    ){
        parent::__construct($di);
        $this->repository = $repository;
        $this->profileInputValidator = $profileInputValidator;
        $this->profileNamesInputValidator = $profileNamesInputValidator;
        $this->profileAddressesInputValidator = $profileAddressesInputValidator;
        $this->profileCriminalRecordsInputValidator = $profileCriminalRecordsInputValidator;
        $this->profileEducationsInputValidator = $profileEducationsInputValidator;
        $this->profileEmailsInputValidator = $profileEmailsInputValidator;
        $this->profileImagesInputValidator = $profileImagesInputValidator;
        $this->profileJobsInputValidator = $profileJobsInputValidator;
        $this->profileLanguagesInputValidator = $profileLanguagesInputValidator;
        $this->profilePhonesInputValidator = $profilePhonesInputValidator;
        $this->profileRelationshipsInputValidator = $profileRelationshipsInputValidator;
        $this->profileSkillsInputValidator = $profileSkillsInputValidator;
        $this->profileSocialProfilesInputValidator = $profileSocialProfilesInputValidator;
        $this->profileUsernamesInputValidator = $profileUsernamesInputValidator;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $this->validateInputs();
        $createNewProfileRecord = $this->createNewProfileRecord( $this->getInput('profile') );
        dd($createNewProfileRecord);

        // get inputs as an array

        // create profile entity object

        // fill profile entity object from the inputs

        // save profile entity object

        return $this;
    }

    //
    // LEVEL 1
    //
    protected function validateInputs()
    {
        $profile = $this->getInput('profile');
        $this->profileInputValidator->validate($profile);

        if(isset($profile['names'])) $this->profileNamesInputValidator->validate($profile['names']);
        if(isset($profile['addresses'])) $this->profileAddressesInputValidator->validate($profile['addresses']);
        if(isset($profile['criminalRecords'])) $this->profileCriminalRecordsInputValidator->validate($profile['criminalRecords']);
        if(isset($profile['educations'])) $this->profileEducationsInputValidator->validate($profile['educations']);
        if(isset($profile['emails'])) $this->profileEmailsInputValidator->validate($profile['emails']);
        if(isset($profile['images'])) $this->profileImagesInputValidator->validate($profile['images']);
        if(isset($profile['jobs'])) $this->profileJobsInputValidator->validate($profile['jobs']);
        if(isset($profile['languages'])) $this->profileLanguagesInputValidator->validate($profile['languages']);
        if(isset($profile['phones'])) $this->profilePhonesInputValidator->validate($profile['phones']);
        if(isset($profile['relationships'])) $this->profileRelationshipsInputValidator->validate($profile['relationships']);
        if(isset($profile['skills'])) $this->profileSkillsInputValidator->validate($profile['skills']);
        if(isset($profile['socialProfiles'])) $this->profileSocialProfilesInputValidator->validate($profile['socialProfiles']);
        if(isset($profile['usernames'])) $this->profileUsernamesInputValidator->validate($profile['usernames']);

    }

    protected function createNewProfileRecord($profileInputs): IProfileEntity
    {
        $profileEntity = $this->di->make(ProfileEntity::class);
        $this->fillProfileEntity($profileEntity, $profileInputs, true);
        foreach ($profileInputs as $profilePartKey => $profilePartInput) {
            $processingMethodName = "process" . ucfirst($profilePartKey);
            if(method_exists($this, $processingMethodName))
                $this->$processingMethodName($profileEntity, $profilePartInput);
        }
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
            $addressObj = $this->di->make(IProfileAddressEntity::class);
            $this->fillAddressEntity($profileEntity,$addressObj,$address);
            $profileEntity->addAddress($addressObj);
        }
    }

    protected function processCriminalRecords(IProfileEntity $profileEntity, array $criminalRecords)
    {
        foreach ($criminalRecords as $criminalRecord) {
            $criminalRecordObj = $this->di->make(IProfileCriminalRecordEntity::class);
            $this->fillCriminalRecordEntity($profileEntity,$criminalRecordObj,$criminalRecord);
            $profileEntity->addCriminalRecord($criminalRecordObj);
        }
    }

    protected function processEducations(IProfileEntity $profileEntity, array $educations)
    {
        foreach ($educations as $education) {
            $educationObj = $this->di->make(IProfileEducationEntity::class);
            $this->fillEducationEntity($profileEntity,$educationObj,$education);
            $profileEntity->addEducation($educationObj);
        }
    }

    protected function processEmails(IProfileEntity $profileEntity, array $emails)
    {
        foreach ($emails as $email) {
            $emailObj = $this->di->make(IProfileEmailEntity::class);
            $this->fillEmailEntity($profileEntity,$emailObj,$email);
            $profileEntity->addEmail($emailObj);
        }
    }

    protected function processImages(IProfileEntity $profileEntity, array $images)
    {
        foreach ($images as $image) {
            $imageObj = $this->di->make(IProfileImageEntity::class);
            $this->fillImageEntity($profileEntity,$imageObj,$image);
            $profileEntity->addImage($imageObj);
        }
    }

    protected function processJobs(IProfileEntity $profileEntity, array $jobs)
    {
        foreach ($jobs as $job) {
            $jobObj = $this->di->make(IProfileJobEntity::class);
            $this->fillJobEntity($profileEntity,$jobObj,$job);
            $profileEntity->addJob($jobObj);
        }
    }

    protected function processLanguages(IProfileEntity $profileEntity, array $languages)
    {
        foreach ($languages as $language) {
            $languageObj = $this->di->make(IProfileLanguageEntity::class);
            $this->fillLanguageEntity($profileEntity,$languageObj,$language);
            $profileEntity->addLanguage($languageObj);
        }
    }

    protected function processPhones(IProfileEntity $profileEntity, array $phones)
    {
        foreach ($phones as $phone) {
            $phoneObj = $this->di->make(IProfilePhoneEntity::class);
            $this->fillPhoneEntity($profileEntity,$phoneObj,$phone);
            $profileEntity->addPhone($phoneObj);
        }
    }

    protected function processRelationships(IProfileEntity $profileEntity, array $relationships)
    {
        foreach ($relationships as $relationship) {
            $relationshipObj = $this->di->make(IProfileRelationshipEntity::class);
            $this->fillRelationshipEntity($profileEntity,$relationshipObj,$relationship);
            $profileEntity->addRelationship($relationshipObj);
        }
    }

    protected function processSkills(IProfileEntity $profileEntity, array $skills)
    {
        foreach ($skills as $skill) {
            $skillObj = $this->di->make(IProfileSkillEntity::class);
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
            $usernameObj = $this->di->make(IProfileUsernameEntity::class);
            $this->fillUsernameEntity($profileEntity,$usernameObj,$username);
            $profileEntity->addUsername($usernameObj);
        }
    }


}
