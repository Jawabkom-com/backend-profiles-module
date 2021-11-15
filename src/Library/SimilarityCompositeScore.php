<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\similarity\ISimilarityCompositeScore;

class SimilarityCompositeScore implements ISimilarityCompositeScore
{
    private IProfileComposite $compositeOne;
    private IProfileComposite $compositeTwo;

    public function calculate(IProfileComposite $compositeOne, IProfileComposite $compositeTwo): int
    {
        $this->compositeOne = $compositeOne;
        $this->compositeTwo = $compositeTwo;

        $nameScore = $this->calculateNamesSimilarityScore();
        $emailScore = $this->calculateEmailSimilarityScore();
        $usernameScore = $this->calculateUsernameSimilarityScore();
        $phoneScore = $this->calculatePhoneSimilarityScore();

        $score = [];
        if($emailScore) {
            if($phoneScore) {
                $score[] = floor($emailScore * 0.4);
                $score[] = floor($phoneScore * 0.3);
            } else {
                $score[] = floor($emailScore * 0.7);
            }
            $score[] = floor($nameScore * 0.2);
            $score[] = floor($usernameScore * 0.1);
        } else if($phoneScore) {
            $score[] = floor($phoneScore * 0.5);
            $score[] = floor($nameScore * 0.4);
            $score[] = floor($usernameScore * 0.1);
        } else if($usernameScore) {
            $score[] = floor($usernameScore * 0.5);
            $score[] = floor($nameScore * 0.3);
        }

        return array_sum($score);
    }

    /**
     * @return float|int
     */
    protected function calculateUsernameSimilarityScore(): int|float
    {
        $aUsernames = [];
        $matchedUsernames = 0;
        foreach ($this->compositeOne->getUsernames() as $username) {
            $aUsernames[$username->getUsername()] = true;
        }

        foreach ($this->compositeTwo->getUsernames() as $username) {
            if (isset($aUsernames[$username->getUsername()])) {
                $matchedUsernames++;
            }
        }
        return ($matchedUsernames > 2 ? 100 : $matchedUsernames * 20);
    }

    /**
     * @return float|int
     */
    protected function calculateEmailSimilarityScore(): int|float
    {
        $aEmails = [];
        $matchedEmails = 0;
        foreach ($this->compositeOne->getEmails() as $email) {
            $aEmails[$email->getEmail()] = true;
        }

        foreach ($this->compositeTwo->getEmails() as $email) {
            if (isset($aEmails[$email->getEmail()])) {
                $matchedEmails++;
            }
        }
        return ($matchedEmails > 2 ? 100 : $matchedEmails * 40);
    }

    /**
     * @return float|int
     */
    protected function calculatePhoneSimilarityScore(): int|float
    {
        $aPhones = [];
        $matchedPhones = 0;
        foreach ($this->compositeOne->getPhones() as $oPhone) {
            $aPhones[$oPhone->getFormattedNumber()] = true;
        }

        foreach ($this->compositeTwo->getPhones() as $oPhone) {
            if (isset($aPhones[$oPhone->getFormattedNumber()])) {
                $matchedPhones++;
            }
        }

        return ($matchedPhones > 2 ? 100 : $matchedPhones * 40);
    }

    private function calculateNamesSimilarityScore(): float|int
    {
        $aComposite1Names = $this->extractNames($this->compositeOne);
        $aComposite2Names = $this->extractNames($this->compositeTwo);
        $aAllNames = array_merge($aComposite1Names, $aComposite2Names);

        $matchesCount = 0;
        foreach($aComposite1Names as $name => $tmp) {
            if(isset($aComposite2Names[$name])) {
                $matchesCount++;
            }
        }

        return ceil(($matchesCount / count($aAllNames)) * 100);
    }

    protected function extractNames(IProfileComposite $composite): array
    {
        $extractedNames = [];
        foreach ($composite->getNames() as $oName) {
            $aNameParts = explode(' ', $oName->getFirst().' '.$oName->getMiddle().' '.$oName->getLast());
            foreach($aNameParts as $part) {
                $part = trim(strtolower($part));
                if($part) {
                    $extractedNames[$part] = true;
                }
            }
        }
        return $extractedNames;
    }
}