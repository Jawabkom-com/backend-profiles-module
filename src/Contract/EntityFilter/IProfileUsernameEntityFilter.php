<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

interface IProfileUsernameEntityFilter
{
    public function filter(IProfileUsernameEntity $entity):void;
}
