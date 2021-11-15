<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Libraries;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface ICompositeScoring
{
    public function score(IProfileComposite $composite):int;
}