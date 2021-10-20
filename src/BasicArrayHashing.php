<?php

namespace Jawabkom\Backend\Module\Profile;


use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;

class BasicArrayHashing implements IArrayHashing
{
    public function hash(array $inputs, bool $ignoreBlanks = true): string
    {
        $singleDArray = $this->multiDArray2OneDArray($inputs, $ignoreBlanks);
        sort($singleDArray);
        return sha1(implode(',', $singleDArray));
    }

    protected function multiDArray2OneDArray(array $inputs, bool $ignoreBlanks)
    {
        $toReturn = [];
        foreach($inputs as $inputKey => $inputValues) {
            if(!is_array($inputValues)) {
                if( ($ignoreBlanks && !empty($inputValues)) || !$ignoreBlanks)
                    $toReturn[] = "{$inputKey}={$inputValues}";
            } else {
                if(isset($inputValues[0])) {
                    foreach($inputValues as $inputValue) {
                        $toReturn = array_merge($toReturn, $this->multiDArray2OneDArray($inputValue, $ignoreBlanks));
                    }
                } else {
                    $toReturn = array_merge($toReturn, $this->multiDArray2OneDArray($inputValues, $ignoreBlanks));
                }
            }
        }
        return $toReturn;
    }
}