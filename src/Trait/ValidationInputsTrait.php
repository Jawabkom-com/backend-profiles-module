<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Validator\ProfileAddressesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileCriminalRecordsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileEducationsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileEmailsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileEntityValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileIdInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileImagesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileJobsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileLanguagesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileMetaDataInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileNamesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfilePhonesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileRelationshipsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileSkillsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileSocialProfilesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileUsernamesInputValidator;

trait ValidationInputsTrait
{

    private function validateProfileInputs(array $profile)
    {
        $validator = $this->di->make(ProfileInputValidator::class);
        $validator->validate($profile);
    }

    private function validateLanguageInputs(array $languages)
    {
        if ($languages){
            $validator = $this->di->make(ProfileLanguagesInputValidator::class);
            $validator->validate($languages);
        }
    }


    private function validateNameInputs(array $names)
    {
        if ($names){
            $validator = $this->di->make(ProfileNamesInputValidator::class);
            $validator->validate($names);
        }
    }

    private function validatePhoneInputs(array $phones)
    {
         if ($phones){
            $validator = $this->di->make(ProfilePhonesInputValidator::class);
            $validator->validate($phones);
         }
    }

    private function validateAddressInputs(array $addresses)
    {
         if ($addresses){
            $validator = $this->di->make(ProfileAddressesInputValidator::class);
            $validator->validate($addresses);
         }
    }
    private function validateUsernameInputs(array $usernames)
    {
         if ($usernames){
            $validator = $this->di->make(ProfileUsernamesInputValidator::class);
            $validator->validate($usernames);
         }
    }

    private function validateEmailInputs(array $emails)
    {
         if ($emails){
            $validator = $this->di->make(ProfileEmailsInputValidator::class);
            $validator->validate($emails);
         }
    }

    private function validateCriminalRecordsInputs(array $records)
    {
         if ($records){
            $validator = $this->di->make(ProfileCriminalRecordsInputValidator::class);
            $validator->validate($records);
         }
    }

    private function validateEducationsInputs(array $educations)
    {
         if ($educations){
            $validator = $this->di->make(ProfileEducationsInputValidator::class);
            $validator->validate($educations);
         }
    }

    private function validateImagesInputs(array $images)
    {
         if ($images){
            $validator = $this->di->make(ProfileImagesInputValidator::class);
            $validator->validate($images);
         }
    }

    private function validateJobsInputs(array $jobs)
    {
         if ($jobs){
            $validator = $this->di->make(ProfileJobsInputValidator::class);
            $validator->validate($jobs);
         }
    }

    private function validateRelationshipsInputs(array $relationships)
    {
         if ($relationships){
            $validator = $this->di->make(ProfileRelationshipsInputValidator::class);
            $validator->validate($relationships);
         }
    }

    private function validateSkillsInputs(array $skills)
    {
         if ($skills){
            $validator = $this->di->make(ProfileSkillsInputValidator::class);
            $validator->validate($skills);
         }
    }

    private function validateSocialProfilesInputs(array $socialProfiles)
    {
         if ($socialProfiles){
            $validator = $this->di->make(ProfileSocialProfilesInputValidator::class);
            $validator->validate($socialProfiles);
         }
    }

    private function validateMetaDataInputs(array $metaData)
    {
         if ($metaData){
            $validator = $this->di->make(ProfileMetaDataInputValidator::class);
            $validator->validate($metaData);
         }

    }
    private function validateProfileIdInput(string $profileId)
    {
       $validator = $this->di->make(ProfileIdInputValidator::class);
       $validator->validate($profileId);
    }
    private function validateProfileIdExits(string $profileId)
    {
         if ($profileId){
            $entityValidator        = $this->di->make(ProfileEntityValidator::class);
            $entityValidator->validate($this->repository->profileIdExist($profileId));
         }
    }

}
