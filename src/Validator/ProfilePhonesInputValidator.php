<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\Country;

class ProfilePhonesInputValidator
{
    protected array $structure = [
        'valid_since',
        'type',
        'do_not_call_flag',
        'country_code',
        'risky_phone',
        'disposable_phone',
        'carrier',
        'purpose',
        'industry',
        'possible_countries',

        // below shouldn't be empty
        'original_number',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $phones) {
            foreach ($phones as $inputKey => $inputValue) {
                if (!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: ' . __CLASS__ . ", input key is not defined '{$inputKey}'");
                }

                if (isset($inputValue)) {
                    switch ($inputKey) {
                        case 'country_code':
                            Country::assertCountryCodeExists($inputValue, $this->getErrorMessage('country_code input value must be a valid country code.', $inputValue));
                            break;
                        case 'possible_countries':
                            foreach ($inputValue as $countryCode) {
                                Country::assertCountryCodeExists($countryCode, $this->getErrorMessage('possible_countries input value must be a valid country codes list.', $countryCode));
                            }
                            break;

                        case 'do_not_call_flag':
                        case 'valid_phone':
                        case 'risky_phone':
                        case 'disposable_phone':
                            if (!is_bool($inputValue)) {
                                throw new InvalidInputValue($this->getErrorMessage($inputKey . ' input value must be either true or false', $inputValue));
                            }
                            break;
                    }

                    // other validators goes here

                }
            }
            $this->validateNullOrEmptyInputs($phones);
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            $this->isNullOrEmptyString($fields['original_number'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }


    protected function isNullOrEmptyString($str)
    {
        return (!isset($str) || trim($str) === '');
    }


    protected function getErrorMessage(string $message, $inputValue) {
        $stringInputValue = json_encode($inputValue);
        return "[Profile Phones] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
