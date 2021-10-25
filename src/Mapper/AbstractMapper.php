<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Standard\Contract\IDependencyInjector;

abstract class AbstractMapper
{
    protected IDependencyInjector $di;

    public function __construct(IDependencyInjector $di)
    {
        $this->di = $di;
    }
}
