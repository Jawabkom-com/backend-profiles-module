<?php
namespace Jawabkom\Backend\Module\Profile;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;

class ProfileCompositeToArrayMapper implements IProfileCompositeToArrayMapper
{

    /**
     * @param IProfileComposite $profileComposite
     * @return array
     */
    public function map(IProfileComposite $profileComposite): array
    {
       $formatted = $this->arrayMapper->map($profileComposite->getProfile());
       unset($formatted['profile_id']);
       unset($formatted['hash']);
       return $formatted;
    }
}