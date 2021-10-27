<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileEmailsInputValidator
{
    protected array $structure = [
        'valid_since',
        'email',
        //'esp_domain',
        'type',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $emails) {
            foreach($emails as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    // other validators goes here
                }
            }
        }
    }
}