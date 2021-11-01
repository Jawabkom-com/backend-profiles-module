<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Libraries;

interface INameScoring
{
    public function score(string $fullName):int;
}
