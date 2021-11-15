<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileEmailsInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        'valid_since',
        'type',

        // below shouldn't be null together
        'email'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $email) {
            $this->validateNullOrEmptyInputs($email);
            foreach($email as $inputKey => $inputValue) {
                $this->assertDefinedInputKeysOnly($email);
                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'email':
                            if (!filter_var($inputValue, FILTER_VALIDATE_EMAIL))
                                throw new InvalidEmailAddressFormat($this->getErrorMessage('email input value must be a valid format.', $inputValue));
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
            empty($fields['email'])
        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }
}
