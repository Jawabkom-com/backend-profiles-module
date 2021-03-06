<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Similarity;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;

interface ISimilarityCompositeScore
{
    public function calculate(IProfileComposite $compositeOne,IProfileComposite $compositeTwo):int;
}