<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileUsernameHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileUsernameEntityToArrayMapper;

class ProfileUsernameHashGenerator implements IProfileUsernameHashGenerator
{

    private IProfileUsernameEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileUsernameEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileUsernameEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $usernameArray = $this->arrayMapper->map($entity);
        unset($usernameArray['valid_since']);
        $usernameArray['profile_id'] = $profileId;
        return $arrayHashing->hash($usernameArray);
    }
}