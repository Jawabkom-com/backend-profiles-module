<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileRelationshipsInputValidator extends AbstractInputValidator
{
    protected array $structure = ['valid_since', 'type',
        // below shouldn't be null/empty together
        'first_name', 'last_name'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $relationship) {
            $this->validateNullOrEmptyInputs($relationship);
            foreach($relationship as $inputKey => $inputValue) {
                $this->assertDefinedInputKeysOnly($relationship);

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
            empty($fields['first_name']) &&
            empty($fields['last_name'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }
}
