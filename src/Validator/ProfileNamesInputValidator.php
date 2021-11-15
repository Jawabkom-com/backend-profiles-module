<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;

class ProfileNamesInputValidator
{
    protected array $structure = [
        'prefix',

        // below shouldn't be null together
        'first', 'middle', 'last'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $name) {
            $this->validateNullOrEmptyInputs($name);
            foreach($name as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    // other validators goes here
                }
            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            empty($fields['first']) &&
            empty($fields['middle']) &&
            empty($fields['last'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }




}
