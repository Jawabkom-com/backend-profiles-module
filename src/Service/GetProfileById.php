<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeMergeRepository;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class GetProfileById extends AbstractService
{

    public function __construct(IDependencyInjector $di)
    {
        parent::__construct($di);
    }

    public function process(): static
    {
        $profileId = $this->getInput('profile_id');
        $profileCompositeFacade = $this->di->make(IProfileCompositeFacade::class);
        if(strpos($profileId, 'merge_') === 0) {
            $mergeLibrary = $this->di->make(ICompositesMerge::class);
            $mergeRepository = $this->di->make(IProfileCompositeMergeRepository::class);
            $mergeEntity = $mergeRepository->getByMergeId($profileId);

            $profileComposites = [];
            foreach($mergeEntity->getProfileIds() as $profileId) {
                $profileComposites[] = $profileCompositeFacade->getCompositeByProfileId($profileId);
            }

            $this->setOutput('profile', $mergeLibrary->merge($profileComposites));
        } else {
            $this->setOutput('profile', $profileCompositeFacade->getCompositeByProfileId($profileId));
        }
        return $this;
    }


}