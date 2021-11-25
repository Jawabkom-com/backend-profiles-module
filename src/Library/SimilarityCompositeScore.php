<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ISearchableText;
use Jawabkom\Backend\Module\Profile\Contract\Similarity\ISimilarityCompositeScore;

class SimilarityCompositeScore implements ISimilarityCompositeScore
{
    private IProfileComposite $compositeOne;
    private IProfileComposite $compositeTwo;
    private ISearchableText $searchableText;

    public function __construct(ISearchableText $searchableText)
    {

        $this->searchableText = $searchableText;
    }

    public function calculate(IProfileComposite $compositeOne, IProfileComposite $compositeTwo): int
    {
        $this->compositeOne = $compositeOne;
        $this->compositeTwo = $compositeTwo;

        $nameScore = $this->calculateNamesSimilarityScore();
        $matchedEmails = $this->calculateEmailSimilarityScore();
        $matchedUsername = $this->calculateUsernameSimilarityScore();
        $matchedPhone = $this->calculatePhoneSimilarityScore();

        if ($matchedEmails) {
            if ($matchedEmails >= 2 || $matchedPhone) {
                return 100;
            } else {
                if ($nameScore >= 20 || $matchedUsername) {
                    return 80;
                }
            }
            return 40;
        } else if ($matchedPhone) {
            if ($matchedPhone >= 2) {
                return 100;
            } else {
                if ($nameScore >= 20 || $matchedUsername) {
                    return 80;
                }
            }
            return 40;
        } else if ($matchedUsername) {
            if ($nameScore >= 20 && $matchedUsername >= 2) {
                return 80;
            }elseif ($nameScore == 100){
                return 60;
            }
            return 40;
        }
        return 0;
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
        return $matchedUsernames;
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
        return $matchedEmails;
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
        return $matchedPhones;
    }

    private function calculateNamesSimilarityScore(): float|int
    {
        $toReturn = 0;
        $aComposite1Names = $this->extractNames($this->compositeOne);
        $aComposite2Names = $this->extractNames($this->compositeTwo);
        if ($aComposite1Names && $aComposite2Names) {

            if(count($aComposite2Names) > count($aComposite1Names)) {
                $nameWithMaxParts = $aComposite2Names;
                $nameWithLessParts = $aComposite1Names;
            } else {
                $nameWithMaxParts = $aComposite1Names;
                $nameWithLessParts = $aComposite2Names;
            }
            $matchesCount = 0;
            foreach ($nameWithLessParts as $name => $tmp) {
                if (isset($nameWithMaxParts[$name])) {
                    $matchesCount++;
                }
            }
            $toReturn = ceil($matchesCount / count($nameWithMaxParts) * 100);
        }
        return $toReturn;
    }

    protected function extractNames(IProfileComposite $composite): array
    {
        $extractedNames = [];
        foreach ($composite->getNames() as $oName) {
            $fullName = $this->searchableText->prepare($oName->getFirst() . ' ' . $oName->getMiddle() . ' ' . $oName->getLast());
            $aNameParts = explode(' ', $fullName);
            foreach ($aNameParts as $part) {
                $part = trim(strtolower($part));
                if ($part) {
                    $extractedNames[$part] = true;
                }
            }
        }
        return $extractedNames;
    }
}