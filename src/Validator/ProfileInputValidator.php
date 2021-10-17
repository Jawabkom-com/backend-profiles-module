<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

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

    /**
     * @throws InvalidInputStructure
     * @throws MissingRequiredInputException
     */
    public function validate(array $inputs)
    {
        if(empty($inputs['data_source'])){
            throw new MissingRequiredInputException('data_source* missing,is required');
        }
        foreach ($inputs as $inputKey => $inputValue) {
            if(!in_array($inputKey, $this->structure)) {
                throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
            }
        }
    }
}