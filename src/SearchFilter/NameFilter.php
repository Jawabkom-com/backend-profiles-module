<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class NameFilter implements IProfileCompositeSearchFilter
{

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function apply(IProfileComposite $composite): bool
    {
        foreach($composite->getNames() as $name) {
            if($name->getDisplay() == $this->name) {
                return true;
            }
        }
        return false;
    }
}