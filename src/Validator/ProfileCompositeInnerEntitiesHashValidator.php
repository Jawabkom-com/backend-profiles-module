<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Exception\EntityHashAlreadyExists;

class ProfileCompositeInnerEntitiesHashValidator
{

    /**
     * @throws EntityHashAlreadyExists
     */
    public function validate(IProfileComposite $objectComposite)
    {
        $this->duplicateChecker($objectComposite->getNames());
        $this->duplicateChecker($objectComposite->getMetaData());
        $this->duplicateChecker($objectComposite->getCriminalRecords());
        $this->duplicateChecker($objectComposite->getEducations());
        $this->duplicateChecker($objectComposite->getJobs());
        $this->duplicateChecker($objectComposite->getRelationships());
        $this->duplicateChecker($objectComposite->getEmails());
        $this->duplicateChecker($objectComposite->getSocialProfiles());
        $this->duplicateChecker($objectComposite->getSkills());
        $this->duplicateChecker($objectComposite->getLanguages());
        $this->duplicateChecker($objectComposite->getImages());
        $this->duplicateChecker($objectComposite->getUsernames());
        $this->duplicateChecker($objectComposite->getAddresses());
        $this->duplicateChecker($objectComposite->getPhones());
    }

    protected function duplicateChecker(array $entities):void
    {
        $hashes = [];
        foreach ($entities as $entity) {
            if (in_array($entity->getHash(),$hashes)) {
                $entityName = get_class($entity).' => '.basename(get_class($entity));
                throw new EntityHashAlreadyExists('Entity Duplicate founded, twice [ '.$entityName.' ] '.serialize($entity));
            }
            $hashes[] = $entity->getHash();
        }
    }
}
