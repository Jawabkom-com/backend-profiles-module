<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Composite\Filters;
use Jawabkom\Standard\Contract\IFilter;

class Filter extends AbstractFilter
{
    protected string $operationType ='=';
    public function toArray(): array
    {
       return array($this->getName()=>[$this->getOperation()=>$this->getValue()]);
    }

}