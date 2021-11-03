<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfilePhoneEntityToArrayMapper;

class ProfilePhoneEntityToArrayMapper implements IProfilePhoneEntityToArrayMapper
{

    public function map(IProfilePhoneEntity $phoneEntity): array
    {
      return [
          'type' =>$phoneEntity->getType(),
          'do_not_call_flag'=>$phoneEntity->getDoNotCallFlag(),
          'country_code'=>$phoneEntity->getCountryCode(),
          'original_number'=>$phoneEntity->getOriginalNumber(),
          'formatted_number'=>$phoneEntity->getFormattedNumber(),
          'valid_phone'=>$phoneEntity->getValidPhone(),
          'risky_phone'=>$phoneEntity->getRiskyPhone(),
          'disposable_phone'=>$phoneEntity->getDisposablePhone(),
          'possible_countries'=>$phoneEntity->getPossibleCountries(),
          'carrier'=>$phoneEntity->getCarrier(),
          'purpose'=>$phoneEntity->getPurpose(),
          'industry'=>$phoneEntity->getIndustry(),
          'valid_since'=>$phoneEntity->getValidSince()?->format('Y-m-d')
      ];
    }
}
