<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileRelationshipsInputValidator
{
    protected array $structure = ['valid_since', 'type', 'first_name', 'last_name'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $relationships) {
            foreach($relationships as $inputKey => $inputValue) {
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
