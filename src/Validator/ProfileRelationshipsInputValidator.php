<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileRelationshipsInputValidator
{
    protected array $structure = ['valid_since', 'type',
        // below shouldn't be null/empty together
        'first_name', 'last_name'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $relationships) {
            $this->validateNullOrEmptyInputs($relationships);
            foreach($relationships as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('valid_since input value must be a valid date.', $inputValue));
                            break;
                    }
                }
            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            $this->isNullOrEmptyString($fields['first_name']) &&
            $this->isNullOrEmptyString($fields['last_name'])

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
        return "[Profile Relationships] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
