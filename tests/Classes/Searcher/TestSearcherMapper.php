<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Standard\Contract\IDependencyInjector;

class TestSearcherMapper implements IProfileEntityMapper
{
    use ProfileAddEditMethods;
    private IDependencyInjector $di;
    private IProfileEntity $profile;

    public function __construct()
    {
        $this->di = new DI();
    }

    /**
     * @param mixed $searchResult
     * @return IProfileEntity[]
     */
    public function map(mixed $searchResult): iterable
    {
       $personals = $searchResult['possible_persons']??[];
        if ($personals){
            $newProfileEntity = $this->di->make(IProfileRepository::class);
            foreach ($personals as $personal){
                $this->profile = $newProfileEntity->createEntity();
                $this->createNewProfile($personal);
                $this->addNamesEntityIfExists($personal['names']??[]);
            }
        }
    }

    private function addNamesEntityIfExists(iterable $names)
    {
        $nameRepository = $this->di->make(IProfileNameRepository::class);
            foreach ($names as $name){
               $newNameEntity =  $nameRepository->createEntity();
               $nameInput['first']  = $name['first']??'';
               $nameInput['middle'] = $name['middle']??'';
               $nameInput['last']   = $name['last']??'';
               $nameInput['prefix'] = $name['prefix']??'';
               $this->fillNameEntity($this->profile,$newNameEntity,$nameInput);
               $newNameEntity->saveEntity();
        }
    }

    /**
     * @param $content
     */
    protected function createNewProfile($personal): void
    {
        $gender                       = $personal ['gender']['content'];
        $personalInput['gender']      = $gender;
        $personalInput['data_source'] = 'pipl';
        $this->fillProfileEntity($this->profile, $personalInput, true);
    }
}
