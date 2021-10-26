<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;

class ProfileLanguagesInputValidator
{
    protected array $structure = ['language', 'country'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $name) {
            foreach($name as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                switch ($inputKey) {
                    case 'language':
                        if($inputValue && strlen($inputValue) !== 2) {
                            throw new InvalidInputValue('language input value must be a valid language code.');
                        }
                        break;
                    case 'country':
                        if($inputValue && strlen($inputValue) !== 2) {
                            throw new InvalidInputValue('country input value must be a valid country code.');
                        }
                        break;
                }
            }
        }
    }
}
