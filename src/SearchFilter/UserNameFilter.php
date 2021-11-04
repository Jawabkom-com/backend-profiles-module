<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class UserNameFilter implements IProfileCompositeSearchFilter
{
    protected string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    public function apply(IProfileComposite $composite): bool
    {
        foreach($composite->getUsernames() as $username) {
            if($username->getUsername() == $this->userName) {
                return true;
            }
        }
        return false;
    }
}