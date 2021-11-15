<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileUsernamesInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        'valid_since',

        // below shouldn't be null/empty
        'username',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $username) {
            $this->validateNullOrEmptyInputs($username);
            $this->assertDefinedInputKeysOnly($username);
            foreach ($username as $inputKey => $inputValue) {
                if (isset($inputValue)) {
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
        if (empty($fields['username'])) {
            throw new MissingValueException("inputs should not be empty");
        }
    }

}
