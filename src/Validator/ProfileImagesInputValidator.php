<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidUrlFormat;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileImagesInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        'valid_since',

        // below shouldn't be null together
        'original_url'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $image) {
            $this->validateNullOrEmptyInputs($image);
            $this->assertDefinedInputKeysOnly($image);
            foreach($image as $inputKey => $inputValue) {
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
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (empty($fields['original_url'])) {
            throw new MissingValueException($this->getErrorMessage("inputs should not be empty", null));
        }
    }

}
