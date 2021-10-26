<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use phpDocumentor\Reflection\Types\Iterable_;

interface IProfileComposite
{
    public function setProfile(IProfileEntity $profileEntity);
    public function getProfile():IProfileEntity;

    public function addName(IProfileNameEntity $IProfileEntityName);

    /**
     * @return IProfileNameEntity[]
     */
    public function getNames(): iterable;
    public function setNames(iterable $names);

    public function addPhone(IProfilePhoneEntity $IProfileEntityPhone);

    /**
     * @return IProfilePhoneEntity[]
     */
    public function getPhones(): iterable;
    public function setPhones(iterable $phones);

    public function addAddress(IProfileAddressEntity $IProfileEntityAddress);

    /**
     * @return IProfileAddressEntity[]
     */
    public function getAddresses(): iterable;
    public function setAddresses(iterable $addresses);

    public function addUsername(IProfileUsernameEntity $IProfileEntityUsername);

    /**
     * @return IProfileNameEntity[]
     */
    public function getUsernames(): iterable;
    public function setUsernames(iterable $usernames);

    public function addEmail(IProfileEmailEntity $IProfileEntityEmail);

    /**
     * @return IProfileEmailEntity[]
     */
    public function getEmails(): iterable;
    public function setEmails(iterable $emails);

    public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship);

    /**
     * @return IProfileRelationshipEntity[]
     */
    public function getRelationships(): iterable;

    public function setRelationships(iterable $relationships);

    public function addSkill(IProfileSkillEntity $IProfileEntitySkill);

    /**
     * @return IProfileSkillEntity[]
     */
    public function getSkills(): iterable;
    public function setSkills(iterable $skills);

    public function addImage(IProfileImageEntity $IProfileEntityImage);

    /**
     * @return IProfileImageEntity[]
     */
    public function getImages(): iterable;
    public function setImages(iterable $images);

    public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage);

    /**
     * @return IProfileLanguageEntity[]
     */
    public function getLanguages(): iterable;
    public function setLanguages(iterable $languages);

    public function addJob(IProfileJobEntity $IProfileEntityJob);

    /**
     * @return IProfileJobEntity[]
     */
    public function getJobs(): iterable;
    public function setJobs(iterable $jobs);

    public function addEducation(IProfileEducationEntity $IProfileEntityEducation);

    /**
     * @return IProfileEducationEntity[]
     */
    public function getEducations(): iterable;
    public function setEducations(iterable $educations);

    public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile);

    /**
     * @return IProfileSocialProfileEntity[]
     */
    public function getSocialProfiles(): iterable;
    public function setSocialProfiles(iterable $socialProfiles);

    public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord);

    /**
     * @return IProfileCriminalRecordEntity[]
     */
    public function getCriminalRecords(): iterable;
    public function setCriminalRecords(iterable $criminalRecords);

    public function addMetaData(IProfileMetaDataEntity $profileMetaDataEntity);

    /**
     * @return IProfileMetaDataEntity[]
     */
    public function getMetaData(): iterable;
    public function setMetaData(iterable $metaData);
}
