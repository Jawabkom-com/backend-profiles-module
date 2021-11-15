<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidUrlFormat;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileSocialProfilesInputValidator extends AbstractInputValidator
{
    protected array $structure = ['valid_since', 'type',

        // below shouldn't be null/empty together
        'url' , 'username' , 'account_id'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $socialProfile) {
            $this->validateNullOrEmptyInputs($socialProfile);
            $this->assertDefinedInputKeysOnly($socialProfile);
            foreach($socialProfile as $inputKey => $inputValue) {
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
            empty($fields['url']) &&
            empty($fields['username']) &&
            empty($fields['account_id'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }

}
