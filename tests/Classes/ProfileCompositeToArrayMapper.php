<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;

class ProfileCompositeToArrayMapper implements IProfileCompositeToArrayMapper
{
    private IProfileEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileEntityToArrayMapper $arrayMapper)
    {

        $this->arrayMapper = $arrayMapper;
    }

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