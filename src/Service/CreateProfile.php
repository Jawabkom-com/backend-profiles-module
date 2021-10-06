<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    protected IProfileRepository $repository;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository)
    {
        parent::__construct($di);
        $this->repository = $repository;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        // get inputs as an array

        // create profile entity object

        // fill profile entity object from the inputs

        // save profile entity object

        return $this;
    }

}