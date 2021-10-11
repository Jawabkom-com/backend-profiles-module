<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfilePhonesInputValidator
{
    protected array $structure = [
        'profile_id',
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
            }
        }
    }
}