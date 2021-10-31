<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Exception\EntityHashAlreadyExists;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddress;

class ProfileCompositeInnerEntitiesHashValidator
{

    public function validate(IProfileComposite $oComposite)
    {
        $this->validateNames($oComposite->getNames());

    }

    /**
     * @param IProfileNameEntity[] $aNames
     */
    protected function validateNames(array $aNames)
    {
        $hashes = [];
        foreach ($aNames as $oName) {
            if (!isset($hashes[$oName->getHash()])) {
                $hashes[$oName->getHash()] = true;
            } else {
                throw new EntityHashAlreadyExists('Name entity founded twice - '.serialize($oName));
            }
        }
    }
}
