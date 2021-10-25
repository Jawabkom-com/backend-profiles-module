<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Facade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface IProfileCompositeFacade
{
    public function getCompositeByProfileId(string $profileId):?IProfileComposite;
}
