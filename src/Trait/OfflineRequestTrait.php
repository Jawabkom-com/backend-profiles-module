<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileCompositeEntitiesFilter;
use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestEntity;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;
use Jawabkom\Backend\Module\Profile\Validator\ProfileCompositeInnerEntitiesHashValidator;

trait OfflineRequestTrait
{
    protected function initOfflineSearchRequest(string $offlineSearchHash): ?IOfflineSearchRequestEntity
    {
            $entity = $this->offlineSearchRequestRepository->createEntity();
            $entity->setRequestDateTime(new \DateTime());
            $entity->setHash($offlineSearchHash);
            $entity->setOtherParams($this->getInput('requestMeta', []));
            $entity->setMatchesCount(0);
            $entity->setStatus('init');
            $entity->setRequestFilters($this->getInputs());
            $this->offlineSearchRequestRepository->saveEntity($entity);
            return $entity;
    }

    protected function setSucceededSearchRequestStatus(IOfflineSearchRequestEntity $entity, int $matches): void
    {
        $entity->setMatchesCount($matches);
        $entity->setStatus('done');
        $this->offlineSearchRequestRepository->saveEntity($entity);
    }

    protected function setErrorSearchRequestStatus(IOfflineSearchRequestEntity $entity, \Throwable $exception): void
    {
        $entity->setMatchesCount(0);
        $entity->setStatus('error');
        $entity->addError("Time: " . date('Y-m-d H:i:s') . ", File: {$exception->getFile()}, Line: {$exception->getLine()}, Message: {$exception->getMessage()}, Type: " . get_class($exception));
        $this->offlineSearchRequestRepository->saveEntity($entity);
    }

}
