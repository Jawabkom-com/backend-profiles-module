<?php

namespace Jawabkom\Backend\Module\Profile\Contract\similarity;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface ISimilarityCompositeScore
{
    public function setComposites(IProfileComposite $compositeOne,IProfileComposite $compositeTwo):static;
    public function calculate():int|float;
}