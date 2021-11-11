<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;

class CompositeMerge implements ICompositesMerge
{

    private IProfileComposite $profileComposite;

    public function __construct(IProfileComposite $profileComposite)
    {
        $this->profileComposite = $profileComposite;
    }

    public function merge(IProfileComposite ...$composites): IProfileComposite
    {
        $hashes = [];
        foreach ($composites as $composite) {
            $this->verifyEmailHash($hashes,$composite->getEmails());
        }
        return $this->profileComposite;
    }

    protected function verifyEmailHash(&$hashes,array $entities)
    {
        foreach ($entities as $entity) {
            if (!in_array($entity->getHash(), $hashes)) {
                $this->profileComposite->addEmail($entity);
                $hashes[] = $entity->getHash();
            }
        }
    }
}
