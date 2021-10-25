<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;

class ProfileCompositeToArrayMapper implements IProfileCompositeToArrayMapper
{

    /**
     * @param IProfileComposite $profileComposite
     * @return array
     */
    public function map(IProfileComposite $profileComposite): array
    {
        $toReturn = [
            'phones' => $this->wrapResult($profileComposite->getPhones()),
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

    public function wrapResult(iterable $results)
    {
        $toReturn = [];
        foreach ($results as $result) {
            $resultArray =$result->toArray();
            unset($resultArray['local_path']);
            unset($resultArray['person_id']);
           if (key_exists('valid_since',$resultArray)){
               $resultArray['valid_since'] = $resultArray['valid_since']->format('Y-m-d h:m:i');
           }
            $toReturn[] = $resultArray;
        }
        return $toReturn;
    }
}