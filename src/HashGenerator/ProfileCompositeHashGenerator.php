<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;

class ProfileCompositeHashGenerator implements IProfileCompositeHashGenerator
{

    public function generate(IProfileComposite $composite, IArrayHashing $arrayHashing): string
    {
        $hashes = [
            'profile' => ,
            'names' => $this->getNameHashes($composite->getNames()),
            'phones' => ,
            'addresses' => ,
            'usernames' => ,
            'emails' => ,
            'relationships' => ,
            'skills' => ,
            'images' => ,
            'languages' => ,
            'jobs' => ,
            'educations' => ,
            'social_profiles' => ,
            'criminal_records' => ,
            'meta_data' => ,
        ];

        return $arrayHashing->hash($hashes);
    }

    /**
     * @param IProfileNameEntity[] $entities
     */
    protected function getNameHashes(array $entities)
    {
        if($entities) {
            $hashes = [];
            foreach($entities as $entity) {
                $hash = $entity->getHash();
                if(!$hash) {
                    //todo: throw exception
                }
                $hashes[] = $entity->getHash();
            }
            return $hashes;
        }
        return null;
    }
}