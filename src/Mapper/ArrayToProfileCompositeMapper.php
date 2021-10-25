<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfilePhoneEntityMapper;

class ArrayToProfileCompositeMapper extends AbstractMapper implements IArrayToProfileCompositeMapper
{

    public function map(array $profile): IProfileComposite
    {
        $profileComposite = $this->di->make(IProfileComposite::class);
        $this->mapPhones($profile, $profileComposite);

        'addresses',
        'usernames',
        'emails',
        'relationships',
        'skills',
        'images',
        'languages',
        'jobs',
        'educations',
        'social_profiles',
        'criminal_records',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'data_source',
        'meta_data',


        return $profileComposite;
    }

    protected function mapPhones(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['phones'])) {
            $mapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
            foreach ($profile['phones'] as $phone) {
                $mapper->map($phone, $oPhone);
                $profileComposite->addPhone($oPhone);
            }
        }
    }
}