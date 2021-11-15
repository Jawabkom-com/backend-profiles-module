<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Doctrine\Common\Cache\Psr6\InvalidArgument;
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
        $score[] = $this->calculateUsernameScore();
        $score[] = $this->calculateEmailScore();
        $score[] = $this->calculatePhoneScore();
       return number_format((array_sum($score) / count($score))*100, 2, '.', '');
    }

    protected function validate($composite){
        if (empty($composite)){
            throw new MissingRequiredInputException('Missing required argument,');
        }
        if (!$composite instanceof IProfileComposite){
            throw new InvalidArgument('Invalid Argument ,must be ProfileComposite instance');
        }
    }

    /**
     * @return float|int
     */
    protected function calculateUsernameScore(): int|float
    {
        $arrayScore = [];
        if (count($this->compositeOne->getUsernames()) > count($this->compositeTwo->getUsernames())){
            $outerArray = $this->compositeOne->getUsernames();
            $innerArray = $this->compositeTwo->getUsernames();
        }else{
            $outerArray = $this->compositeTwo->getUsernames();
            $innerArray = $this->compositeOne->getUsernames();
        }
        foreach ($outerArray as $usernameOuter) {
            foreach ($innerArray as $usernameInner) {
                $arrayScore[] = $usernameOuter->getUsername() == $usernameInner->getUsername()?1:0;
            }
        }
        return array_sum($arrayScore) / count($arrayScore);
    }

    /**
     * @return float|int
     */
    protected function calculateEmailScore(): int|float
    {
        $arrayScore = [];
        if (count($this->compositeOne->getEmails()) > count($this->compositeTwo->getEmails())){
            $outerArray = $this->compositeOne->getEmails();
            $innerArray = $this->compositeTwo->getEmails();
        }else{
            $outerArray = $this->compositeTwo->getEmails();
            $innerArray = $this->compositeOne->getEmails();
        }
        foreach ($outerArray as $emailOuter) {
            foreach ($innerArray as $emailInner) {
                $arrayScore[] = $emailOuter->getEmail() == $emailInner->getEmail()?1:0;
            }
        }
        return array_sum($arrayScore) / count($arrayScore);
    }
    /**
     * @return float|int
     */
    protected function calculatePhoneScore(): int|float
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
}