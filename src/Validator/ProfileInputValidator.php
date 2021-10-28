<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;
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
        'data_source',
        'meta_data',
    ];

    /**
     * @throws InvalidInputStructure
     * @throws MissingRequiredInputException
     */
    public function validate(array $inputs)
    {
        if(empty($inputs['data_source'])) {
            throw new MissingRequiredInputException('data_source* missing,is required');
        }
        foreach ($inputs as $inputKey => $inputValue) {
            if(!in_array($inputKey, $this->structure)) {
                throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
            }

            if(isset($inputValue)) {
                switch ($inputKey) {
                    case 'date_of_birth':
                        DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', 'date_of_birth input value must be a valid date.');
                        break;
                    case 'place_of_birth':
                        Country::assertCountryCodeExists($inputValue, 'place_of_birth input value must be a valid country code.');
                        break;
                    case 'gender':
                        if(!is_null($inputValue) && !in_array($inputValue, ['male', 'female'])) {
                            throw new InvalidInputValue('gender input value must be either mail or female.');
                        }
                        break;
                }

                // other validators goes here
            }

        }
    }
}
