<?php

namespace Jawabkom\Backend\Module\Profile\Contract;


interface IArrayHashing
{
    public function hash(array $inputs, bool $ignoreBlanks = true):string;
}
