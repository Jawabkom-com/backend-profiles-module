<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileNamesInputValidator
{
    protected array $structure = ['prefix', 'first', 'middle', 'last'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $name) {
            foreach($name as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }
            }
        }
    }
}