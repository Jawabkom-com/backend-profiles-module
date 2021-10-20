<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setGender(string $gender );
    public function getGender():string;

    public function setDateOfBirth(\DateTime $dateOfBirth );
    public function getDateOfBirth():\DateTime;

    public function setPlaceOfBirth(string $placeOfBirth );
    public function getPlaceOfBirth():string;

    public function setDataSource(string $dataSource );
    public function getDataSource():string;

    public function addName(IProfileNameEntity $IProfileEntityName);

    /**
     * @return IProfileNameEntity[]
     */
    public function getNames():iterable;

    public function addPhone(IProfilePhoneEntity $IProfileEntityPhone);

    /**
     * @return IProfilePhoneEntity[]
     */
    public function getPhones():iterable;

    public function addAddress(IProfileAddressEntity $IProfileEntityAddress);

    /**
     * @return IProfileAddressEntity[]
     */
    public function getAddresses():iterable;

    public function addUsername(IProfileUsernameEntity $IProfileEntityUsername);

    /**
     * @return IProfileNameEntity[]
     */
    public function getUsernames():iterable;

    public function addEmail(IProfileEmailEntity $IProfileEntityEmail);

    /**
     * @return IProfileEmailEntity[]
     */
    public function getEmails():iterable;

    public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship);

    /**
     * @return IProfileRelationshipEntity[]
     */
    public function getRelationships():iterable;

    public function addSkill(IProfileSkillEntity $IProfileEntitySkill);

    /**
     * @return IProfileSkillEntity[]
     */
    public function getSkills():iterable;

    public function addImage(IProfileImageEntity $IProfileEntityImage);

    /**
     * @return IProfileImageEntity[]
     */
    public function getImages():iterable;

    public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage);

    /**
     * @return IProfileLanguageEntity[]
     */
    public function getLanguages():iterable;

    public function addJob(IProfileJobEntity $IProfileEntityJob);

    /**
     * @return IProfileJobEntity[]
     */
    public function getJobs():iterable;

    public function addEducation(IProfileEducationEntity $IProfileEntityEducation);

    /**
     * @return IProfileEducationEntity[]
     */
    public function getEducations():iterable;

    public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile);

    /**
     * @return IProfileSocialProfileEntity[]
     */
    public function getSocialProfiles():iterable;

    public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord);

    /**
     * @return IProfileCriminalRecordEntity[]
     */
    public function getCriminalRecords():iterable;

    public function addMetaData(IProfileMetaDataEntity $profileMetaDataEntity);
    public function getMetaData():iterable;
}
