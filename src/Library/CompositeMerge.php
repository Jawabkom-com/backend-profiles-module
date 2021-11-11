<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
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

    public function merge(IProfileComposite ...$composites): IProfileComposite
    {
        $mergeComposite = $this->di->make(IProfileComposite::class);
        $this->mergeNames($composites, $mergeComposite);
        $this->mergePhones($composites, $mergeComposite);

        $mergeComposite->getProfile()->setHash($this->profileCompositeHashGenerator->generate($mergeComposite, $this->arrayHashing));
        return $mergeComposite;
    }

    /**
     * @param IProfileComposite[] $composites
     * @param IProfileComposite $mergeComposite
     */
    protected function mergeProfileEntity(array $composites, IProfileComposite $mergeComposite)
    {
       foreach ($composites as $composite) {
           if(!$mergeComposite->getProfile()->getDateOfBirth() && $composite->getProfile()->getDateOfBirth()) {
               $mergeComposite->getProfile()->setDateOfBirth($composite->getProfile()->getDateOfBirth());
           }

           // todo: as the above code for the gender, place of birth
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

}
