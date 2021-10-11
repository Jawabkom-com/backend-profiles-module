<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileInputValidator
{
    protected array $structure = [
        'names',
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

    public function validate(array $inputs)
    {
        foreach ($inputs as $inputKey => $inputValue) {
            if(!in_array($inputKey, $this->structure)) {
                throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
            }
        }
    }
}