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

    protected function multiDArray2OneDArray(array $inputs, bool $ignoreBlanks, string $keyPrefix = '')
    {
        $toReturn = [];
        foreach($inputs as $inputKey => $inputValues) {
            if(!is_array($inputValues)) {
                if( ($ignoreBlanks && !empty($inputValues)) || !$ignoreBlanks)
                    if(is_int($inputKey)) {
                        $toReturn[] = "{$keyPrefix} = {$this->castInputValue2String($inputValues)}";
                    } else {
                        $toReturn[] = "{$keyPrefix}.{$inputKey}={$this->castInputValue2String($inputValues)}";
                    }
            } else {
                $toReturn = array_merge($toReturn, $this->multiDArray2OneDArray($inputValues, $ignoreBlanks, "{$keyPrefix}".(is_int($inputKey) ? '' : ".{$inputKey}") ));
            }
        }
        return $toReturn;
    }

    protected function castInputValue2String($inputValues)
    {
        if ($inputValues instanceof \DateTime)  $inputValues = $inputValues->format('Y-m-d H:i:s');
        return $inputValues;
    }
}
