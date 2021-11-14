<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidUrlFormat;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileImagesInputValidator
{
    protected array $structure = [
        'valid_since',

        // below shouldn't be null together
        'original_url'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $images) {
            foreach($images as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'original_url':
                            if (!filter_var($inputValue, FILTER_VALIDATE_URL))
                                throw new InvalidUrlFormat($this->getErrorMessage('original_url input value must be a valid format.', $inputValue));
                            break;
                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('valid_since input value must be a valid date.', $inputValue));
                            break;
                    }
                }
            }
            $this->validateNullOrEmptyInputs($images);
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if ($this->isNullOrEmptyString($fields['original_url'])) {
            throw new MissingValueException("inputs should not be empty");
        }
    }


    protected function isNullOrEmptyString($str)
    {
        return (!isset($str) || trim($str) === '');
    }

    protected function getErrorMessage(string $message, $inputValue) {
        $stringInputValue = json_encode($inputValue);
        return "[Profile Images] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
