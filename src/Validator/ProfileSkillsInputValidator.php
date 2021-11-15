<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileSkillsInputValidator extends AbstractInputValidator
{
    protected array $structure = ['valid_since', 'level',
        // below shouldn't be null/empty together
        'skill'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $skill) {
            $this->validateNullOrEmptyInputs($skill);
            foreach($skill as $inputKey => $inputValue) {
                $this->assertDefinedInputKeysOnly($skill);

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
            empty($fields['skill'])
        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }
}
