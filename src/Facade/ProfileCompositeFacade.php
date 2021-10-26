<?php

namespace Jawabkom\Backend\Module\Profile\Facade;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ProfileCompositeFacade implements IProfileCompositeFacade
{
    private IProfileRepository $profileRepository;
    private IProfileNameRepository $profileNameRepository;
    private IProfilePhoneRepository $profilePhoneRepository;
    private IProfileAddressRepository $profileAddressRepository;
    private IProfileUsernameRepository $profileUsernameRepository;
    private IProfileEmailRepository $profileEmailRepository;
    private IProfileRelationshipRepository $relationshipRepository;
    private IProfileSkillRepository $profileSkillRepository;
    private IProfileImageRepository $profileImageRepository;
    private IProfileLanguageRepository $profileLanguageRepository;
    private IProfileJobRepository $profileJobRepository;
    private IProfileEducationRepository $profileEducationRepository;
    private IProfileSocialProfileRepository $socialProfileRepository;
    private IProfileCriminalRecordRepository $profileCriminalRecordRepository;
    private IProfileMetaDataRepository $profileMetaDataRepository;
    private IDependencyInjector $di;

    public function __construct(
        IDependencyInjector $di,
        IProfileRepository $profileRepository,
        IProfileNameRepository $profileNameRepository,
        IProfilePhoneRepository $profilePhoneRepository,
        IProfileAddressRepository $profileAddressRepository,
        IProfileUsernameRepository $profileUsernameRepository,
        IProfileEmailRepository $profileEmailRepository,
        IProfileRelationshipRepository $relationshipRepository,
        IProfileSkillRepository $profileSkillRepository,
        IProfileImageRepository $profileImageRepository,
        IProfileLanguageRepository $profileLanguageRepository,
        IProfileJobRepository $profileJobRepository,
        IProfileEducationRepository $profileEducationRepository,
        IProfileSocialProfileRepository $socialProfileRepository,
        IProfileCriminalRecordRepository $profileCriminalRecordRepository,
        IProfileMetaDataRepository $profileMetaDataRepository)
    {

        $this->profileRepository = $profileRepository;
        $this->profileNameRepository = $profileNameRepository;
        $this->profilePhoneRepository = $profilePhoneRepository;
        $this->profileAddressRepository = $profileAddressRepository;
        $this->profileUsernameRepository = $profileUsernameRepository;
        $this->profileEmailRepository = $profileEmailRepository;
        $this->relationshipRepository = $relationshipRepository;
        $this->profileSkillRepository = $profileSkillRepository;
        $this->profileImageRepository = $profileImageRepository;
        $this->profileLanguageRepository = $profileLanguageRepository;
        $this->profileJobRepository = $profileJobRepository;
        $this->profileEducationRepository = $profileEducationRepository;
        $this->socialProfileRepository = $socialProfileRepository;
        $this->profileCriminalRecordRepository = $profileCriminalRecordRepository;
        $this->profileMetaDataRepository = $profileMetaDataRepository;
        $this->di = $di;
    }

    public function getCompositeByProfileId(string $profileId): ?IProfileComposite
    {
        $profileEntity = $this->profileRepository->getByProfileId($profileId);
        if($profileEntity) {
            $profileComposite = $this->di->make(IProfileComposite::class);
            $profileComposite->setProfile($profileEntity);
            $profileComposite->setNames($this->profileNameRepository->getByProfileId($profileId));
            $profileComposite->setPhones($this->profilePhoneRepository->getByProfileId($profileId));
            $profileComposite->setAddresses($this->profileAddressRepository->getByProfileId($profileId));
            $profileComposite->setUsernames($this->profileUsernameRepository->getByProfileId($profileId));
            $profileComposite->setEmails($this->profileEmailRepository->getByProfileId($profileId));
            $profileComposite->setRelationships($this->relationshipRepository->getByProfileId($profileId));
            $profileComposite->setSkills($this->profileSkillRepository->getByProfileId($profileId));
            $profileComposite->setImages($this->profileImageRepository->getByProfileId($profileId));
            $profileComposite->setLanguages($this->profileLanguageRepository->getByProfileId($profileId));
            $profileComposite->setJobs($this->profileJobRepository->getByProfileId($profileId));
            $profileComposite->setEducations($this->profileEducationRepository->getByProfileId($profileId));
            $profileComposite->setSocialProfiles($this->socialProfileRepository->getByProfileId($profileId));
            $profileComposite->setCriminalRecords($this->profileCriminalRecordRepository->getByProfileId($profileId));
            $profileComposite->setMetaData($this->profileMetaDataRepository->getByProfileId($profileId));
            return $profileComposite;
        }
        return null;
    }
}
