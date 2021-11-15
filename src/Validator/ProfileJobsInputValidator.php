<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileJobsInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        'valid_since', 'from', 'to',

        // below shouldn't be null together
        'title' , 'organization', 'industry'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $jobs) {
            $this->validateNullOrEmptyInputs($jobs);
            foreach($jobs as $inputKey => $inputValue) {
                $this->assertDefinedInputKeysOnly($jobs);
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
            empty($fields['title']) &&
            empty($fields['organization']) &&
            empty($fields['industry'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }

}
