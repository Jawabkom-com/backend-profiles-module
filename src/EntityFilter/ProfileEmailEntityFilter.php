<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileEmailEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;

class ProfileEmailEntityFilter implements IProfileEmailEntityFilter
{

    public function filter(IProfileEmailEntity $entity): void
    {
        if($entity->getEmail()) {
            $entity->setEmail(strtolower(trim($entity->getEmail())));
            $atStrPos = strpos($entity->getEmail(), '@');
            if($atStrPos) {
                $entity->setEspDomain(substr($entity->getEmail(), $atStrPos+1));
            }
        }
    }
}
