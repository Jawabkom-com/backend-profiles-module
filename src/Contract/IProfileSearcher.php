<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileSearcher
{
    public function search(array $filters):mixed;
}
