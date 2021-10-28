<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Language;

class ProfileLanguagesInputValidator
{
    protected array $structure = ['language', 'country'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $languages) {
            foreach($languages as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'language':
                            Language::assertLanguageCodeExists($inputValue,'language input value must be a valid language code.');
                            break;
                        case 'country':
                            Country::assertCountryCodeExists($inputValue, 'country input value must be a valid country code.');
                            break;
                    }

                    // other validators goes here
                }

            }
        }
    }
}
