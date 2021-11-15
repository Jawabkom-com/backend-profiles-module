<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;

class ProfileMetaDataInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        // below shouldn't be null together
        'meta_key', 'meta_value'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $metaData) {
            $this->validateNullOrEmptyInputs($metaData);
            $this->assertDefinedInputKeysOnly($metaData);
            foreach($metaData as $inputKey => $inputValue) {
                if(isset($inputValue)) {
                    // other validators goes here
                }
            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            empty($fields['meta_key']) &&
            empty($fields['meta_value'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }

}
