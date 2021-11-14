<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileJobsInputValidator
{
    protected array $structure = [
        'valid_since', 'from', 'to',

        // below shouldn't be null together
        'title' , 'organization', 'industry'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $jobs) {
            foreach($jobs as $inputKey => $inputValue) {
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

    protected function getErrorMessage(string $message, $inputValue) {
        $stringInputValue = json_encode($inputValue);
        return "[Profile Jobs] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
