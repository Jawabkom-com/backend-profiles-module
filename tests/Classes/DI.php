<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Jawabkom\Standard\Contract\IDependencyInjector;

class DI implements IDependencyInjector
{

    /**
     * @psalm-template RealInstanceType of object
     * @psalm-param class-string<RealInstanceType> $type
     * @psalm-return RealInstanceType
     */
    public function make(string $type, array $arguments = []): mixed
    {
       return app()->make($type,$arguments);
    }
}