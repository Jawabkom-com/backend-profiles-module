<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Ramsey\Uuid\Uuid;

trait ProfileAddEditMethods
{
    protected function fillProfileEntity(IProfileEntity $profileEntity, array $inputs, bool $generateId = true)
    {
        if($generateId) {
            $profileEntity->setProfileId(Uuid::uuid4());
        }
        $profileEntity->setGender($inputs['gender'] ?? '');
        $profileEntity->setDataSource($inputs['data_source'] ?? '');
        $profileEntity->setPlaceOfBirth($inputs['place_of_birth'] ?? '');
        if(isset($inputs['date_of_birth']))
            $profileEntity->setDateOfBirth(new \DateTime($inputs['date_of_birth']));

    }

    protected function fillNameEntity(IProfileEntity $profileEntity, IProfileNameEntity $profileNameEntity, array $name)
    {
        $profileNameEntity->setFirst($name['first'] ?? '');
        $profileNameEntity->setMiddle($name['middle'] ?? '');
        $profileNameEntity->setLast($name['last'] ?? '');
        $profileNameEntity->setPrefix($name['prefix'] ?? '');
        $displayName = preg_replace('#[\s]+#', ' ', trim($profileNameEntity->getPrefix() . ' ' . $profileNameEntity->getFirst() . ' ' . $profileNameEntity->getMiddle() . ' ' . $profileNameEntity->getLast()));
        $profileNameEntity->setDisplay($displayName);
    }

    protected function fillPhoneEntity(IProfileEntity $profileEntity,IProfilePhoneEntity $phoneEntity,array $phone){
        $phoneEntity->setType($phone['type']??'');
        $phoneEntity->setCountryCode($phone['country_code']??'');
        $phoneEntity->setCarrier($phone['carrier']??'');
        $phoneEntity->setCreatedAt(new \DateTime('NOW'));
        $phoneEntity->setDisposablePhone($phone['disposable_phone']??false);
        $phoneEntity->setDoNotCallFlag($phone['do_not_call_flag']??false);
        $phoneEntity->setFormattedNumber($phone['formatted_number']??'');
        $phoneEntity->setProfileId($profileEntity->getProfileId());
        $phoneEntity->setOriginalNumber($phone['original_number']??'');
        $phoneEntity->setPurpose($phone['purpose']??'');
        $phoneEntity->setValidPhone($phone['valid_phone']??false);
        $phoneEntity->setRiskyPhone($phone['risky_phone']??false);
    }

    protected function fillAddressEntity(IProfileEntity $IProfileEntity,IProfileAddressEntity $addressEntity,array $address){
        $addressEntity->setProfileId($IProfileEntity->getProfileId());
        $addressEntity->setBuildingNumber($address['building_number']??'');
        $addressEntity->setCity($address['city']??'');
        $addressEntity->setCountry($address['country']??'');
        $addressEntity->setDisplay($address['display']??'');
        $addressEntity->setState($address['state']??'');
        $addressEntity->setStreet($address['street']??'');
        $addressEntity->setValidSince(new \DateTime('NOW'));
        $addressEntity->setZip($address['zip']??'');
    }

    protected function fillUsernameEntity(IProfileEntity $IProfileEntity,IProfileUsernameEntity $usernameEntity,array $username){
        $usernameEntity->setValidSince(new \DateTime('NOW'));
        $usernameEntity->getProfileId($IProfileEntity->getProfileId());
        $usernameEntity->setUsername($username['username']??'');
    }
}
