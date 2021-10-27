<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileEducationsInputValidator
{
    protected array $structure = ['valid_since', 'from', 'to', 'school' , 'degree' ,'major'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $educations) {
            foreach($educations as $inputKey => $inputValue) {
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
