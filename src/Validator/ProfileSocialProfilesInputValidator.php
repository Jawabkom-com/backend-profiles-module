<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidUrlFormat;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileSocialProfilesInputValidator
{
    protected array $structure = ['valid_since', 'type',

        // below shouldn't be null/empty together
        'url' , 'username' , 'account_id'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $socialProfiles) {
            $this->validateNullOrEmptyInputs($socialProfiles);
            foreach($socialProfiles as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'url':
                            if (!filter_var($inputValue, FILTER_VALIDATE_URL))
                                throw new InvalidUrlFormat($this->getErrorMessage('url input value must be a valid format.', $inputValue));
                            break;
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
            $this->isNullOrEmptyString($fields['url']) &&
            $this->isNullOrEmptyString($fields['username']) &&
            $this->isNullOrEmptyString($fields['account_id'])

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
        return "[Profile Social Profiles] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
