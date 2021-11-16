<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CompositeMerge implements ICompositesMerge
{

    private IDependencyInjector $di;
    private IProfileCompositeHashGenerator $profileCompositeHashGenerator;
    private IArrayHashing $arrayHashing;

    public function __construct(IDependencyInjector $di, IProfileCompositeHashGenerator $profileCompositeHashGenerator, IArrayHashing $arrayHashing)
    {
        $this->di = $di;
        $this->profileCompositeHashGenerator = $profileCompositeHashGenerator;
        $this->arrayHashing = $arrayHashing;
    }

    /**
     * @param IProfileComposite[] $composites
     * @return IProfileComposite
     */
    public function merge(array $composites): IProfileComposite
    {
        $mergeComposite = $this->di->make(IProfileComposite::class);
        $this->mergeProfileEntity($composites, $mergeComposite);
        $this->mergeNames($composites, $mergeComposite);
        $this->mergePhones($composites, $mergeComposite);
        $this->mergeEmails($composites, $mergeComposite);
        $this->mergeAddresses($composites, $mergeComposite);
        $this->mergeCriminalRecords($composites, $mergeComposite);
        $this->mergeEducations($composites, $mergeComposite);
        $this->mergeImages($composites, $mergeComposite);
        $this->mergeJobs($composites, $mergeComposite);
        $this->mergeLanguages($composites, $mergeComposite);
        $this->mergeMetaData($composites, $mergeComposite);
        $this->mergeRelationships($composites, $mergeComposite);
        $this->mergeSkills($composites, $mergeComposite);
        $this->mergeSocialProfiles($composites, $mergeComposite);
        $this->mergeUsernames($composites, $mergeComposite);
        $mergeComposite->getProfile()->setHash($this->profileCompositeHashGenerator->generate($mergeComposite, $this->arrayHashing));
        return $mergeComposite;
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeProfileEntity(array $composites, IProfileComposite $mergeComposite)
    {
        $profileRepository = $this->di->make(IProfileRepository::class);
        $mergeComposite->setProfile($profileRepository);
        foreach ($composites as $composite) {
            if (!$mergeComposite->getProfile()->getDateOfBirth() && $composite->getProfile()->getDateOfBirth()) {
                $mergeComposite->getProfile()->setDateOfBirth($composite->getProfile()->getDateOfBirth());
            }
            if (!$mergeComposite->getProfile()->getGender() && $composite->getProfile()->getGender()) {
                $mergeComposite->getProfile()->setGender($composite->getProfile()->getGender());
            }
            if (!$mergeComposite->getProfile()->getPlaceOfBirth() && $composite->getProfile()->getPlaceOfBirth()) {
                $mergeComposite->getProfile()->setPlaceOfBirth($composite->getProfile()->getPlaceOfBirth());
            }
            if (!$mergeComposite->getProfile()->getDataSource() && $composite->getProfile()->getDataSource()) {
                $mergeComposite->getProfile()->setDataSource($composite->getProfile()->getDataSource());
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeNames(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getNames() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addName($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergePhones(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getPhones() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addPhone($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeEmails(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getEmails() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addEmail($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeAddresses(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getAddresses() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addAddress($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeCriminalRecords(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getCriminalRecords() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addCriminalRecord($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeEducations(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getEducations() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addEducation($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }


    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeImages(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getImages() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addImage($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeJobs(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getJobs() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addJob($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeLanguages(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getLanguages() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addLanguage($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeMetaData(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getMetaData() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addMetaData($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeRelationships(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getRelationships() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addRelationship($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }


    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeSkills(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getSkills() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addSkill($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }


    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeSocialProfiles(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getSocialProfiles() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addSocialProfile($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }


    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeUsernames(array $composites, IProfileComposite $mergeComposite): void
    {
        $addedHashes = [];
        foreach ($composites as $composite) {
            // fill names
            foreach ($composite->getUsernames() as $oEntity) {
                if (!isset($addedHashes[$oEntity->getHash()])) {
                    $mergeComposite->addUsername($oEntity);
                    $addedHashes[$oEntity->getHash()] = true;
                }
            }
        }
    }

}
