<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Exception\MissingHashException;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class ProfileCompositeHashGenerator implements IProfileCompositeHashGenerator
{

    /**
     * @throws MissingHashException
     */
    public function generate(IProfileComposite $composite, IArrayHashing $arrayHashing): string
    {
        $hashes = [
            'profile' => $this->getProfileHash($composite->getProfile(), $arrayHashing),
            'names' => $this->getEntitiesHash($composite->getNames()),
            'phones' => $this->getEntitiesHash($composite->getPhones()),
            'addresses' => $this->getEntitiesHash($composite->getAddresses()),
            'usernames' => $this->getEntitiesHash($composite->getUsernames()),
            'emails' => $this->getEntitiesHash($composite->getEmails()),
            'relationships' => $this->getEntitiesHash($composite->getRelationships()),
            'skills' => $this->getEntitiesHash($composite->getSkills()),
            'images' => $this->getEntitiesHash($composite->getImages()),
            'languages' => $this->getEntitiesHash($composite->getLanguages()),
            'jobs' => $this->getEntitiesHash($composite->getJobs()),
            'educations' => $this->getEntitiesHash($composite->getEducations()),
            'social_profiles' => $this->getEntitiesHash($composite->getSocialProfiles()),
            'criminal_records' => $this->getEntitiesHash($composite->getCriminalRecords()),
            'meta_data' => $this->getEntitiesHash($composite->getMetaData()),
        ];

        return $arrayHashing->hash($hashes);
    }

    protected function getEntitiesHash(array $entities): ?array
    {
        if($entities) {
            $hashes = [];
            foreach($entities as $entity) {
                $hash = $entity->getHash();
                if(!$hash) {
                  throw new MissingHashException('Entity Missing Hashing*,Hash is required');
                }
                $hashes[] = $entity->getHash();
            }
            return $hashes;
        }
        return null;
    }

    protected function getProfileHash(IProfileEntity $getProfile, IArrayHashing $arrayHashing)
    {
        $profileHashGenerator = $this->di->make(IProfileHashGenerator::class);
        return $profileHashGenerator->generate($getProfile, $this->arrayHashing);
    }
}