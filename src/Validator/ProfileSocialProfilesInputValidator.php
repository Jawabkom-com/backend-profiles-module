<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileSocialProfilesInputValidator
{
    protected array $structure = ['valid_since', 'url', 'type' , 'username' , 'account_id'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $socialProfiles) {
            foreach($socialProfiles as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    // other validators goes here
                }
            }
        }
    }
}
