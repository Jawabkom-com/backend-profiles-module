<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCriminalRecordHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEducationHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileHashGenerator;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;
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
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;

trait ProfileHashTrait
{

    protected function hashNames(IProfileComposite $profileComposite)
    {
        $nameHasingGenerator = $this->di->make(IProfileNameHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getNames() as $nameObj) {
            $nameObj->setHash($nameHasingGenerator->generate($nameObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashAddresses(IProfileComposite $profileComposite)
    {
        $addressHasingGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getAddresses() as $addressObj) {
            $addressObj->setHash($addressHasingGenerator->generate($addressObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashCriminalRecords(IProfileComposite $profileComposite)
    {
        $criminalRecordHasingGenerator = $this->di->make(IProfileCriminalRecordHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getCriminalRecords() as $criminalRecordObj) {
            $criminalRecordObj->setHash($criminalRecordHasingGenerator->generate($criminalRecordObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashEducations(IProfileComposite $profileComposite)
    {
        $educationHasingGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getEducations() as $educationObj) {
            $educationObj->setHash($educationHasingGenerator->generate($educationObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashEmails(IProfileComposite $profileComposite)
    {
        $emailHasingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getEmails() as $emailObj) {
            $emailObj->setHash($emailHasingGenerator->generate($emailObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashImages(IProfileComposite $profileComposite)
    {
        $imageHasingGenerator = $this->di->make(IProfileImageHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getImages() as $imageObj) {
            $imageObj->setHash($imageHasingGenerator->generate($imageObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashJobs(IProfileComposite $profileComposite)
    {
        $jobHasingGenerator = $this->di->make(IProfileJobHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getJobs() as $jobObj) {
            $jobObj->setHash($jobHasingGenerator->generate($jobObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashLanguages(IProfileComposite $profileComposite)
    {
        $languageHasingGenerator = $this->di->make(IProfileLanguageHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getLanguages() as $languageObj) {
            $languageObj->setHash($languageHasingGenerator->generate($languageObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashPhones(IProfileComposite $profileComposite)
    {
        $phoneHasingGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getPhones() as $phoneObj) {
            $phoneObj->setHash($phoneHasingGenerator->generate($phoneObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashRelationships(IProfileComposite $profileComposite)
    {
        $relationsHasingGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getRelationships() as $relationshipObj) {
            $relationshipObj->setHash($relationsHasingGenerator->generate($relationshipObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashSkills(IProfileComposite $profileComposite)
    {
        $skillHasingGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getSkills() as $skillObj) {
            $skillObj->setHash($skillHasingGenerator->generate($skillObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashSocialProfiles(IProfileComposite $profileComposite)
    {
        $socialProfileHasingGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getSocialProfiles() as $socialProfileObj) {
            $socialProfileObj->setHash($socialProfileHasingGenerator->generate($socialProfileObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashUsernames(IProfileComposite $profileComposite)
    {
        $usernameHasingGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getUsernames() as $usernameObj) {
            $usernameObj->setHash($usernameHasingGenerator->generate($usernameObj,$profileId,$this->arrayHashing));
        }
    }

    protected function hashMetaData(IProfileComposite $profileComposite)
    {
        $metaDataHasingGenerator = $this->di->make(IProfileMetaDataHashGenerator::class);
        $profileId = $profileComposite->getProfile()->getProfileId();
        foreach ($profileComposite->getMetaData() as $metaObj) {
            $metaObj->setHash($metaDataHasingGenerator->generate($metaObj,$profileId,$this->arrayHashing));
        }
    }



    protected function hashProfileComposite(IProfileComposite $profileComposite): void
    {

        $this->hashAddresses($profileComposite);
        $this->hashCriminalRecords($profileComposite);
        $this->hashEducations($profileComposite);
        $this->hashEmails($profileComposite);
        $this->hashImages($profileComposite);
        $this->hashJobs($profileComposite);
        $this->hashLanguages($profileComposite);
        $this->hashMetaData($profileComposite);
        $this->hashNames($profileComposite);
        $this->hashPhones($profileComposite);
        $this->hashRelationships($profileComposite);
        $this->hashSkills($profileComposite);
        $this->hashSocialProfiles($profileComposite);
        $this->hashUsernames($profileComposite);

        $profileCompositeHashGenerator = $this->di->make(IProfileCompositeHashGenerator::class);
        $profileComposite->getProfile()->setHash($profileCompositeHashGenerator->generate($profileComposite, $this->arrayHashing));
    }

    protected function assertProfileHashDoesNotExists(string $hash)
    {
        if ($this->repository->hashExist($hash))
            throw new ProfileEntityExists('Profile Entity Exist');
    }
}
