<?php
namespace Jawabkom\Backend\Module\Profile\Test\Classes;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Ramsey\Uuid\Uuid;

class ProfileUuidFactory implements IProfileUuidFactory
{

    public function generate(): string
    {
       return Uuid::uuid4();
    }
}