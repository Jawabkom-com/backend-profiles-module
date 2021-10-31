<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

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
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;

trait ProfileHashTrait
{

    protected function hashNames(IProfileComposite $profileComposite)
    {
        $nameHasingGenerator = $this->di->make(IProfileNameHashGenerator::class);
        foreach ($profileComposite->getNames() as $nameObj) {
            $nameObj->setHash($nameHasingGenerator->generate($nameObj, $this->arrayHashing));
        }
    }

    protected function hashAddresses(IProfileComposite $profileComposite)
    {
        $addressHasingGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        foreach ($profileComposite->getAddresses() as $addressObj) {
            $addressObj->setHash($addressHasingGenerator->generate($addressObj, $this->arrayHashing));
        }
    }

    protected function hashCriminalRecords(IProfileComposite $profileComposite)
    {
        $criminalRecordHasingGenerator = $this->di->make(IProfileCriminalRecordHashGenerator::class);
        foreach ($profileComposite->getCriminalRecords() as $criminalRecordObj) {
            $criminalRecordObj->setHash($criminalRecordHasingGenerator->generate($criminalRecordObj, $this->arrayHashing));
        }
    }

    protected function hashEducations(IProfileComposite $profileComposite)
    {
        $educationHasingGenerator = $this->di->make(IProfileEducationHashGenerator::class);
        foreach ($profileComposite->getEducations() as $educationObj) {
            $educationObj->setHash($educationHasingGenerator->generate($educationObj, $this->arrayHashing));
        }
    }

    protected function hashEmails(IProfileComposite $profileComposite)
    {
        $emailHasingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($profileComposite->getEmails() as $emailObj) {
            $emailObj->setHash($emailHasingGenerator->generate($emailObj, $this->arrayHashing));
        }
    }

    protected function hashImages(IProfileComposite $profileComposite)
    {
        $imageHasingGenerator = $this->di->make(IProfileImageHashGenerator::class);
        foreach ($profileComposite->getImages() as $imageObj) {
            $imageObj->setHash($imageHasingGenerator->generate($imageObj, $this->arrayHashing));
        }
    }

    protected function hashJobs(IProfileComposite $profileComposite)
    {
        $jobHasingGenerator = $this->di->make(IProfileJobHashGenerator::class);
        foreach ($profileComposite->getJobs() as $jobObj) {
            $jobObj->setHash($jobHasingGenerator->generate($jobObj, $this->arrayHashing));
        }

    }

    protected function hashLanguages(IProfileComposite $profileComposite)
    {
        $languageHasingGenerator = $this->di->make(IProfileLanguageHashGenerator::class);
        foreach ($profileComposite->getLanguages() as $languageObj) {
            $languageObj->setHash($languageHasingGenerator->generate($languageObj, $this->arrayHashing));
        }
    }

    protected function hashPhones(IProfileComposite $profileComposite)
    {
        $phoneHasingGenerator = $this->di->make(IProfilePhoneHashGenerator::class);
        foreach ($profileComposite->getPhones() as $phoneObj) {
            $phoneObj->setHash($phoneHasingGenerator->generate($phoneObj, $this->arrayHashing));
        }
    }

    protected function hashRelationships(IProfileComposite $profileComposite)
    {
        $relationsHasingGenerator = $this->di->make(IProfileRelationsHashGenerator::class);
        foreach ($profileComposite->getRelationships() as $relationshipObj) {
            $relationshipObj->setHash($relationsHasingGenerator->generate($relationshipObj, $this->arrayHashing));
        }
    }

    protected function hashSkills(IProfileComposite $profileComposite)
    {
        $skillHasingGenerator = $this->di->make(IProfileSkillHashGenerator::class);
        foreach ($profileComposite->getSkills() as $skillObj) {
            $skillObj->setHash($skillHasingGenerator->generate($skillObj, $this->arrayHashing));
        }
    }

    protected function hashSocialProfiles(IProfileComposite $profileComposite)
    {
        $socialProfileHasingGenerator = $this->di->make(IProfileSocialProfileHashGenerator::class);
        foreach ($profileComposite->getSocialProfiles() as $socialProfileObj) {
            $socialProfileObj->setHash($socialProfileHasingGenerator->generate($socialProfileObj, $this->arrayHashing));
        }
    }

    protected function hashUsernames(IProfileComposite $profileComposite)
    {
        $usernameHasingGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        foreach ($profileComposite->getUsernames() as $usernameObj) {
            $usernameObj->setHash($usernameHasingGenerator->generate($usernameObj, $this->arrayHashing));
        }
    }

    protected function hashMetaData(IProfileComposite $profileComposite)
    {
        $metaDataHasingGenerator = $this->di->make(IProfileMetaDataHashGenerator::class);
        foreach ($profileComposite->getMetaData() as $metaObj) {
            $metaObj->setHash($metaDataHasingGenerator->generate($metaObj, $this->arrayHashing));
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
