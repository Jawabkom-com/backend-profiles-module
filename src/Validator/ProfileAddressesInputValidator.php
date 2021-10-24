<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;

class ProfileAddressesInputValidator
{
    protected array $structure = [
        'valid_since',
        'country',
        'state',
        'city',
        'zip',
        'street',
        'building_number',
        'display',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $name) {
            foreach($name as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                switch ($inputKey) {
                    case 'country':
                        if(strlen($inputValue) !== 2) {
                            throw new InvalidInputValue('country input value must be a valid country code.');
                        }
                        break;
                }
            }
        }
    }
}