<?php

namespace Jawabkom\Backend\Module\Profile\Library;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositeScoring;

class CompositeScoring implements ICompositeScoring
{
   private const SCORE_NAMES = 30;
   private const SCORE_PHONES = 30;
   private const SCORE_ADDRESSES = 5;
   private const SCORE_USERNAMES = 5;
   private const SCORE_EMAILS = 20;
   private const SCORE_RELATIONSHIPS = 10;
   private const SCORE_SKILLS = 5;
   private const SCORE_IMAGES = 5;
   private const SCORE_LANGUAGES = 5;
   private const SCORE_JOBS = 5;
   private const SCORE_EDUCATIONS = 5;
   private const SCORE_SOCIAL_PROFILE= 5;
   private const SCORE_CRIMINAL_RECORDS= 5;
   private const SCORE_META_DATA= 0;
   private const SCORE_PLACE_OF_BIRTH= 10;
   private const SCORE_DATE_OF_BIRTH= 10;
   private const SCORE_EMPTY_VALUE =0;

    public function score(IProfileComposite $composite): int
    {
        $compositeScore = [
            empty($composite->getProfile()->getPlaceOfBirth())? self::SCORE_EMPTY_VALUE : self::SCORE_PLACE_OF_BIRTH,
            empty($composite->getProfile()->getDateOfBirth())? self::SCORE_EMPTY_VALUE : self::SCORE_DATE_OF_BIRTH,
            count($composite->getNames()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_NAMES,
            count($composite->getPhones()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_PHONES,
            count($composite->getAddresses()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_ADDRESSES,
            count($composite->getUsernames()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_USERNAMES,
            count($composite->getEmails()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_EMAILS,
            count($composite->getRelationships()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_RELATIONSHIPS,
            count($composite->getSkills()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_SKILLS,
            count($composite->getImages()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_IMAGES,
            count($composite->getLanguages()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_LANGUAGES,
            count($composite->getJobs()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_JOBS,
            count($composite->getEducations()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_EDUCATIONS,
            count($composite->getSocialProfiles()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_SOCIAL_PROFILE,
            count($composite->getCriminalRecords()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_CRIMINAL_RECORDS,
            count($composite->getMetaData()) == 0 ? self::SCORE_EMPTY_VALUE : self::SCORE_META_DATA,
        ];
        return array_sum($compositeScore);
    }
}