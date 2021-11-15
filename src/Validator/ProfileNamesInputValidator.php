<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;

class ProfileNamesInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        'prefix',

        // below shouldn't be null together
        'first', 'middle', 'last'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $name) {
            $this->validateNullOrEmptyInputs($name);
            $this->assertDefinedInputKeysOnly($name);
            foreach($name as $inputKey => $inputValue) {
                if(isset($inputValue)) {
                    // other validators goes here
                }
            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            empty($fields['first']) &&
            empty($fields['middle']) &&
            empty($fields['last'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }




}
