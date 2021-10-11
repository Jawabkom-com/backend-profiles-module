<?php

namespace Jawabkom\Backend\Module\Profile\Trait;


use Jawabkom\Backend\Module\Profile\Validator\ProfileAddressesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileEmailsInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileNamesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfilePhonesInputValidator;

trait ValidationInputsTrait
{

    private function validateProfileInputs(array $profile)
    {
        $validator = $this->di->make(ProfileInputValidator::class);
        $validator->validate($profile);
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
            $validator = $this->di->make(ProfileAddressesInputValidator::class);
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


}
