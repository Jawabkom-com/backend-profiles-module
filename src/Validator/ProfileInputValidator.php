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
                        DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('date_of_birth input value must be a valid date.', $inputValue));
                        break;
                    case 'place_of_birth':
                        Country::assertCountryCodeExists($inputValue, $this->getErrorMessage('place_of_birth input value must be a valid country code.', $inputValue));
                        break;
                    case 'gender':
                        if(!is_null($inputValue) && !in_array($inputValue, ['male', 'female'])) {
                            throw new InvalidInputValue($this->getErrorMessage('gender input value must be either mail or female.', $inputValue));
                        }
                        break;
                }

                // other validators goes here
            }
        }
    }

    protected function getErrorMessage(string $message, $inputValue) {
        $stringInputValue = json_encode($inputValue);
        return "[Main Profile] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
