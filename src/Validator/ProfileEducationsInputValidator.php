<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileEducationsInputValidator
{
    protected array $structure = ['valid_since', 'from', 'to', 'degree',

        // below shouldn't be null together
        'school' ,'major'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $educations) {
            $this->validateNullOrEmptyInputs($educations);
            foreach($educations as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('valid_since input value must be a valid date.', $inputValue));
                            break;
                        case 'from':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('from input value must be a valid date.', $inputValue));
                            break;
                        case 'to':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('to input value must be a valid date.', $inputValue));
                            break;
                    }
                }
            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            $this->isNullOrEmptyString($fields['school']) &&
            $this->isNullOrEmptyString($fields['major'])
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
        return "[Profile Educations] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
