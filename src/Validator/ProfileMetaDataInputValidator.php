<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileMetaDataInputValidator
{
    protected array $structure = ['meta_key', 'meta_value'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $metaDatas) {
            foreach($metaDatas as $inputKey => $inputValue) {
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
