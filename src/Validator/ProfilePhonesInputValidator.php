<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;

class ProfilePhonesInputValidator
{
    protected array $structure = [
        'valid_since',
        'type',
        'do_not_call_flag',
        'country_code',
        'original_number',
        'formatted_number',
        'valid_phone',
        'risky_phone',
        'disposable_phone',
        'carrier',
        'purpose',
        'industry',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $name) {
            foreach ($name as $inputKey => $inputValue) {
                if (!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: ' . __CLASS__ . ", input key is not defined '{$inputKey}'");
                }

                switch ($inputKey) {
                    case 'country_code':
                        if(strlen($inputValue) !== 2) {
                            throw new InvalidInputValue('country_code input value must be a valid country code.');
                        }
                        break;

                    case 'do_not_call_flag':
                    case 'valid_phone':
                    case 'risky_phone':
                    case 'disposable_phone':
                        if(!is_bool($inputValue)) {
                            throw new InvalidInputValue($inputKey.' input value must be either true or false');
                        }
                        break;
                }
            }
        }
    }
}