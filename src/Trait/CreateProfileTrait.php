<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileCompositeEntitiesFilter;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;
use Jawabkom\Backend\Module\Profile\Validator\ProfileCompositeInnerEntitiesHashValidator;

trait CreateProfileTrait
{
    use ValidationInputsTrait;

    /**
     * @throws ProfileEntityExists
     */
    protected function createNewProfileRecord(IProfileComposite $profileComposite,$profileId=''): void
    {
        if (empty($profileId)){
            $uuidFactory = $this->di->make(IProfileUuidFactory::class);
            $profileId   = $uuidFactory->generate();
        }
        $profileCompositeEntitiesFilter = $this->di->make(IProfileCompositeEntitiesFilter::class);
        $profileCompositeEntitiesFilter->filter($profileComposite);
        $profileComposite->getProfile()->setProfileId($profileId);
        $this->hashProfileComposite($profileComposite);
        $this->assertProfileHashDoesNotExists($profileComposite->getProfile()->getHash());
        $duplicateValidator = $this->di->make(ProfileCompositeInnerEntitiesHashValidator::class);
        $duplicateValidator->validate($profileComposite);
        $this->persistProfileComposite($profileComposite);
    }

    protected function validateInputs(array $profile)
    {
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

    protected function persistNames(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileNameRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getNames() as $nameObj) {
            $nameObj->setProfileId($profileId);
            $repository->saveEntity($nameObj);
        }
    }

    protected function persistAddresses(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileAddressRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getAddresses() as $addressObj) {
            $addressObj->setProfileId($profileId);
            $repository->saveEntity($addressObj);
        }
    }

    protected function persistCriminalRecords(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileCriminalRecordRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getCriminalRecords() as $criminalRecordObj) {
            $criminalRecordObj->setProfileId($profileId);
            $repository->saveEntity($criminalRecordObj);
        }
    }

    protected function persistEducations(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileEducationRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getEducations() as $educationObj) {
            $educationObj->setProfileId($profileId);
            $repository->saveEntity($educationObj);
        }
    }

    protected function persistEmails(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileEmailRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getEmails() as $emailObj) {
            $emailObj->setProfileId($profileId);
            $repository->saveEntity($emailObj);
        }
    }

    protected function persistImages(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileImageRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getImages() as $imageObj) {
            $imageObj->setProfileId($profileId);
            $repository->saveEntity($imageObj);
        }
    }

    protected function persistJobs(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileJobRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getJobs() as $jobObj) {
            $jobObj->setProfileId($profileId);
            $repository->saveEntity($jobObj);
        }
    }

    protected function persistLanguages(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileLanguageRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getLanguages() as $languageObj) {
            $languageObj->setProfileId($profileId);
            $repository->saveEntity($languageObj);
        }
    }

    protected function persistPhones(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfilePhoneRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getPhones() as $phoneObj) {
            $phoneObj->setProfileId($profileId);
            $repository->saveEntity($phoneObj);
        }
    }

    protected function persistRelationships(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileRelationshipRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getRelationships() as $relationshipObj) {
            $relationshipObj->setProfileId($profileId);
            $repository->saveEntity($relationshipObj);
        }
    }

    protected function persistSkills(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileSkillRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getSkills() as $skillObj) {
            $skillObj->setProfileId($profileId);
            $repository->saveEntity($skillObj);
        }
    }

    protected function persistSocialProfiles(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileSocialProfileRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getSocialProfiles() as $socialProfileObj) {
            $socialProfileObj->setProfileId($profileId);
            $repository->saveEntity($socialProfileObj);
        }
    }

    protected function persistUsernames(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileUsernameRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getUsernames() as $usernameObj) {
            $usernameObj->setProfileId($profileId);
            $repository->saveEntity($usernameObj);
        }
    }

    protected function persistMetaData(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileMetaDataRepository::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getMetaData() as $metaObj) {
            $metaObj->setProfileId($profileId);
            $repository->saveEntity($metaObj);
        }
    }

    protected function persistProfileComposite(IProfileComposite $profileComposite): void
    {
        $this->repository->saveEntity($profileComposite->getProfile());

        $this->persistAddresses($profileComposite);
        $this->persistCriminalRecords($profileComposite);
        $this->persistEducations($profileComposite);
        $this->persistEmails($profileComposite);
        $this->persistImages($profileComposite);
        $this->persistJobs($profileComposite);
        $this->persistLanguages($profileComposite);
        $this->persistMetaData($profileComposite);
        $this->persistNames($profileComposite);
        $this->persistPhones($profileComposite);
        $this->persistRelationships($profileComposite);
        $this->persistSkills($profileComposite);
        $this->persistSocialProfiles($profileComposite);
        $this->persistUsernames($profileComposite);
    }
}
