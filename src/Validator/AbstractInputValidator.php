<?php

namespace Jawabkom\Backend\Module\Profile\Validator;


use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class AbstractInputValidator
{
    protected array $structure = [];

    protected function getErrorMessage(string $message, $inputValue) {
        $stringInputValue = json_encode($inputValue);
        $classNameOnly = basename(get_class($this));
        return "[{$classNameOnly}] {$message} - Invalid Value [{$stringInputValue}]";
    }

    protected function assertDefinedInputKeysOnly(array $input)
    {
        foreach($input as $inputKey => $inputValue) {
            if (!in_array($inputKey, $this->structure)) {
                throw new InvalidInputStructure($this->getErrorMessage('Input key is not defined', $inputKey));
            }
        }
    }
}
