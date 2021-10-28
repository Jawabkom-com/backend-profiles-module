<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCriminalRecordHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEducationHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileImageHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileJobHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileNameHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileNameEntityMapper;

trait CreateProfileTrait
{
    use ValidationInputsTrait;

    private IArrayHashing $arrayHashing;

    public function __construct(IArrayHashing $arrayHashing)
    {

        $this->arrayHashing = $arrayHashing;
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
        $nameHasingGenerator = $this->di->make(IProfileNameHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getNames() as $nameObj) {
            $nameObj->setProfileId($profileId);
            $nameObj->setHash($nameHasingGenerator->generate($nameObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($nameObj);
        }
    }

    protected function persistAddresses(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileAddressRepository::class);
        $addressHasingGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getAddresses() as $addressObj) {
            $addressObj->setProfileId($profileId);
            $addressObj->setHash($addressHasingGenerator->generate($addressObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($addressObj);
        }
    }

    protected function persistCriminalRecords(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileCriminalRecordRepository::class);
        $criminalRecordHasingGenerator = $this->di->make(IProfileCriminalRecordHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getCriminalRecords() as $criminalRecordObj) {
            $criminalRecordObj->setProfileId($profileId);
            $criminalRecordObj->setHash($criminalRecordHasingGenerator->generate($criminalRecordObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($criminalRecordObj);
        }
    }

    protected function persistEducations(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileEducationRepository::class);
        $educationHasingGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getEducations() as $educationObj) {
            $educationObj->setProfileId($profileId);
            $educationObj->setHash($educationHasingGenerator->generate($educationObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($educationObj);
        }
    }

    protected function persistEmails(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileEmailRepository::class);
        $emailHasingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getEmails() as $emailObj) {
            $emailObj->setProfileId($profileId);
            $emailObj->setHash($emailHasingGenerator->generate($emailObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($emailObj);
        }
    }

    protected function persistImages(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileImageRepository::class);
        $imageHasingGenerator = $this->di->make(IProfileImageHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getImages() as $imageObj) {
            $imageObj->setProfileId($profileId);
            $imageObj->setHash($imageHasingGenerator->generate($imageObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($imageObj);
        }
    }

    protected function persistJobs(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileJobRepository::class);
        $jobHasingGenerator = $this->di->make(IProfileJobHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getJobs() as $jobObj) {
            $jobObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $jobObj->setHash($jobHasingGenerator->generate($jobObj,$profileId,$this->arrayHashing));
            $repository->saveEntity($jobObj);
        }
    }

    protected function persistLanguages(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileLanguageRepository::class);
        foreach ($profileComposite->getLanguages() as $languageObj) {
            $languageObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $repository->saveEntity($languageObj);
        }
    }

    protected function persistPhones(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfilePhoneRepository::class);
        foreach ($profileComposite->getPhones() as $phoneObj) {
            $phoneObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $repository->saveEntity($phoneObj);
        }
    }

    protected function persistRelationships(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileRelationshipRepository::class);
        foreach ($profileComposite->getRelationships() as $relationshipObj) {
            $relationshipObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $repository->saveEntity($relationshipObj);
        }
    }

    protected function persistSkills(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileSkillRepository::class);
        foreach ($profileComposite->getSkills() as $skillObj) {
            $skillObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $repository->saveEntity($skillObj);
        }
    }

    protected function persistSocialProfiles(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileSocialProfileRepository::class);
        foreach ($profileComposite->getSocialProfiles() as $socialProfileObj) {
            $socialProfileObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $repository->saveEntity($socialProfileObj);
        }
    }

    protected function persistUsernames(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileUsernameRepository::class);
        foreach ($profileComposite->getUsernames() as $usernameObj) {
            $usernameObj->setProfileId($profileComposite->getProfile()->getProfileId());
            $repository->saveEntity($usernameObj);
        }
    }

    protected function persistMetaData(IProfileComposite $profileComposite)
    {
        $repository = $this->di->make(IProfileMetaDataRepository::class);
        foreach ($profileComposite->getMetaData() as $metaObj) {
            $metaObj->setProfileId($profileComposite->getProfile()->getProfileId());
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
