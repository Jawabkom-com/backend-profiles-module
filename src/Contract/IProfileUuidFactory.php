<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileUuidFactory
{
    public function generate():string;
}