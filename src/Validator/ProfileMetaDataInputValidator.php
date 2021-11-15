<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;

class ProfileMetaDataInputValidator
{
    protected array $structure = [
        // below shouldn't be null together
        'meta_key', 'meta_value'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $metaDatas) {
            $this->validateNullOrEmptyInputs($metaDatas);
            foreach($metaDatas as $inputKey => $inputValue) {
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
            $this->isNullOrEmptyString($fields['meta_key']) &&
            $this->isNullOrEmptyString($fields['meta_value'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }


    protected function isNullOrEmptyString($str)
    {
        return (!isset($str) || trim($str) === '');
    }

}
