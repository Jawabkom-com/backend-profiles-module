<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Libraries;

interface ISearchableText
{
    public function prepare(string $text):string;
}
