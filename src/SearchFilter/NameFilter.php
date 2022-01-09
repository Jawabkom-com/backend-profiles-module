<?php

namespace Jawabkom\Backend\Module\Profile\SearchFilter;


use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;

class NameFilter implements IProfileCompositeSearchFilter
{

    private array $nameParts;

    public function __construct(string $name)
    {
        $parts = explode(' ', $name);
        foreach($parts as $part) {
            if($part) {
                $this->nameParts[] = $part;
            }
        }
    }

    public function apply(IProfileComposite $composite): bool
    {
        if(count($this->nameParts)) {
            foreach($composite->getNames() as $name) {
                $preStrPos = 0;
                foreach($this->nameParts as $part) {
                    $partStrPos = stripos($name->getDisplay(), $part);
                    if($partStrPos === false || $partStrPos < $preStrPos) {
                        continue 2;
                    } else {
                        $preStrPos = $partStrPos;
                    }
                }
                return true;
            }
        }
        return false;
    }
}