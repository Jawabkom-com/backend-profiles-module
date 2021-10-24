<?php

namespace Jawabkom\Backend\Module\Profile\Contract;


interface IProfileCompositeToArrayMapper
{
    public function map(iterable $results):array;
}
