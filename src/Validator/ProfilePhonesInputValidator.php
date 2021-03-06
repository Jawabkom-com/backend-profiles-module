<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\Country;

class ProfilePhonesInputValidator extends AbstractInputValidator
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
        foreach ($inputs as $phone) {
            $this->validateNullOrEmptyInputs($phone);
            $this->assertDefinedInputKeysOnly($phone);
            foreach ($phone as $inputKey => $inputValue) {
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
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (empty($fields['original_number'])) {
            throw new MissingValueException($this->getErrorMessage("inputs should not be empty", null));
        }
    }

}
