<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfilePhoneEntityToArrayMapper;

class ProfileCompositeToArrayMapper extends AbstractMapper implements IProfileCompositeToArrayMapper
{

    /**
     * @param IProfileComposite $profileComposite
     * @return array
     */
    public function map(IProfileComposite $profileComposite): array
    {
        $toReturn = [
            'phones' => $this->mapPhones($profileComposite->getPhones()),
            'addresses' => $this->wrapResult($profileComposite->getAddresses()),
            'usernames' => $this->wrapResult($profileComposite->getUsernames()),
            'emails' => $this->wrapResult($profileComposite->getEmails()),
            'relationships' => $this->wrapResult($profileComposite->getRelationships()),
            'skills' => $this->wrapResult($profileComposite->getSkills()),
            'images' => $this->wrapResult($profileComposite->getImages()),
            'languages' => $this->wrapResult($profileComposite->getLanguages()),
            'jobs' => $this->wrapResult($profileComposite->getJobs()),
            'educations' => $this->wrapResult($profileComposite->getEducations()),
            'social_profiles' => $this->wrapResult($profileComposite->getSocialProfiles()),
            'criminal_records' => $this->wrapResult($profileComposite->getCriminalRecords()),
        ];
       // dd(array_merge($profileComposite->getProfile()->toArray(),$toReturn));
      return array_merge($profileComposite->getProfile()->toArray(),$toReturn);
    }

    public function mapPhones(iterable $phones)
    {
        $toReturn = [];
        if($phones) {
            $phoneEntityToArrayMapper = $this->di->make(IProfilePhoneEntityToArrayMapper::class);
            foreach ($phones as $phone) {
                $toReturn[] = $phoneEntityToArrayMapper->map($phone);
            }
        }
        return $toReturn;
    }
}