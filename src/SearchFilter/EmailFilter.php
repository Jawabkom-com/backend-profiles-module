<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class EmailFilter implements IProfileCompositeSearchFilter
{

    private string $email;

    public function __construct(string $email)
    {
        $this->email = trim(strtolower($email));
    }

    public function apply(IProfileComposite $composite): bool
    {
        foreach($composite->getEmails() as $email) {
            if(trim(strtolower($email->getEmail())) == $this->email) {
                return true;
            }
        }
        return false;
    }
}