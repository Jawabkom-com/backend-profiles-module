<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidUrlFormat;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileImagesInputValidator
{
    protected array $structure = ['original_url', 'valid_since'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $images) {
            foreach($images as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'original_url':
                            if (!filter_var($inputValue, FILTER_VALIDATE_URL))
                                throw new InvalidUrlFormat('original_url input value must be a valid format.');
                            break;
                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', 'valid since input value must be a valid date.');
                            break;
                    }
                }
            }
        }
    }
}
