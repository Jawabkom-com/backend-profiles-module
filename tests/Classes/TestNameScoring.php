<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Jawabkom\Backend\Module\Profile\Contract\Libraries\INameScoring;

class TestNameScoring implements INameScoring
{
    public function score(string $fullName): int
    {
        return 10;
    }
}