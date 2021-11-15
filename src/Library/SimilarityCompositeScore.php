<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use http\Exception\InvalidArgumentException;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\similarity\ISimilarityCompositeScore;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SimilarityCompositeScore implements ISimilarityCompositeScore
{
    private IProfileComposite $compositeOne;
    private IProfileComposite $compositeTwo;

    /**
     * @throws MissingRequiredInputException
     */
    public function setComposites(IProfileComposite $compositeOne, IProfileComposite $compositeTwo): static
    {
       $this->validate($compositeOne);
       $this->validate($compositeTwo);
       $this->compositeOne = $compositeOne;
       $this->compositeTwo = $compositeTwo;
       return $this;
    }

    public function calculate(): int|float
    {
        $score =[
            $this->calculateUsernameSimilarityScore(),
            $this->calculateEmailSimilarityScore(),
            $this->calculatePhoneSimilarityScore(),
            $this->calculateNamesSimilarityScore(),
        ];;
       return number_format((array_sum($score) / count($score)), 2, '.', '');
    }

    protected function validate($composite){
        if (empty($composite)){
            throw new MissingRequiredInputException('Missing required argument,');
        }
        if (!$composite instanceof IProfileComposite){
            throw new InvalidArgumentException('Invalid Argument ,must be ProfileComposite type');
        }
    }

    /**
     * @return float|int
     */
    protected function calculateUsernameSimilarityScore(): int|float
    {
        $aUsernames = [];
        $matchedUsernames = 0;
        foreach($this->compositeOne->getUsernames() as $username) {
            $aUsernames[$username->getUsername()] = true;
        }

        foreach($this->compositeTwo->getUsernames() as $username) {
            if(isset($aUsernames[$username->getUsername()])) {
                $matchedUsernames++;
            }
        }
        return ($matchedUsernames > 2 ? 100 : $matchedUsernames * 20 );
    }

    /**
     * @return float|int
     */
    protected function calculateEmailSimilarityScore(): int|float
    {
        $aEmails = [];
        $matchedEmails = 0;
        foreach($this->compositeOne->getEmails() as $email) {
            $aEmails[$email->getEmail()] = true;
        }

        foreach($this->compositeTwo->getEmails() as $email) {
            if(isset($aEmails[$email->getEmail()])) {
                $matchedEmails++;
            }
        }
        return ($matchedEmails > 2 ? 100 : $matchedEmails * 40 );
    }
    /**
     * @return float|int
     */
    protected function calculatePhoneSimilarityScore(): int|float
    {
        $aPhones = [];
        $matchedPhones = 0;
        foreach($this->compositeOne->getPhones() as $oPhone) {
            $aPhones[$oPhone->getFormattedNumber()] = true;
        }

        foreach($this->compositeTwo->getPhones() as $oPhone) {
            if(isset($aPhones[$oPhone->getFormattedNumber()])) {
                $matchedPhones++;
            }
        }

        return ($matchedPhones > 2 ? 100 : $matchedPhones * 40 );
    }

    private function calculateNamesSimilarityScore(): float|int
    {
        $aNames =[];
        $matchedNames=0;
        foreach($this->compositeOne->getNames() as $oName) {
            $segmentName = explode(' ',$oName->getDisplay());
            $aNames      = array_merge($aNames,$segmentName);
        }
        foreach($this->compositeTwo->getNames() as $oName) {
            $localMatch =0;
            $segmentName = explode(' ',$oName->getDisplay());
            array_map(function ($ele) use($aNames,&$localMatch){
                return in_array($ele,$aNames)?$localMatch++:$localMatch;
            },$segmentName);
             $localMatch <=2 ?:$matchedNames++ ;
        }
        return ($matchedNames > 2 ? 100 : $matchedNames * 40 );

    }
}