<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Library\Country;

class ProfilePhonesInputValidator
{
    protected array $structure = [
        'valid_since',
        'type',
        'do_not_call_flag',
        'country_code',
        'original_number',
        'risky_phone',
        'disposable_phone',
        'carrier',
        'purpose',
        'industry',
        'possible_countries'
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
                            Country::assertCountryCodeExists($inputValue, 'country_code input value must be a valid country code.');
                            break;
                        case 'possible_countries':
                            foreach ($inputValue as $countryCode) {
                                Country::assertCountryCodeExists($countryCode, 'possible_countries input value must be a valid country codes list. Invalid ['.$countryCode.'], LIST: '.json_encode($inputValue));
                            }
                            break;

                        case 'do_not_call_flag':
                        case 'valid_phone':
                        case 'risky_phone':
                        case 'disposable_phone':
                            if (!is_bool($inputValue)) {
                                throw new InvalidInputValue($inputKey . ' input value must be either true or false');
                            }
                            break;
                    }

                    // other validators goes here

                }
            }
        }
    }
}
