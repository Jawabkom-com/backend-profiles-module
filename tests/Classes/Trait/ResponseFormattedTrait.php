<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Trait;

trait ResponseFormattedTrait
{
    use ProfileToArrayTrait;
    private function formattedResponse(iterable $results): array
    {
        $response =[];
        foreach ($results as $result){
            $response[] =$this->profileToArray($result);
        }
        return $response;
    }

}
