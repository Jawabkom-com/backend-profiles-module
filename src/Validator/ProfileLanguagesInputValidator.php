<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Language;

class ProfileLanguagesInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        // below shouldn't be null together
        'language', 'country'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $language) {
            $this->validateNullOrEmptyInputs($language);
            $this->assertDefinedInputKeysOnly($language);
            foreach($language as $inputKey => $inputValue) {
                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'language':
                            Language::assertLanguageCodeExists($inputValue, $this->getErrorMessage('language input value must be a valid language code.', $inputValue));
                            break;
                        case 'country':
                            Country::assertCountryCodeExists($inputValue, $this->getErrorMessage('country input value must be a valid country code.', $inputValue));
                            break;
                    }

                    // other validators goes here
                }

            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            empty($fields['language']) &&
            empty($fields['country'])

        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }

}
