<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileLanguageEntityToArrayMapper;

class ProfileLanguageEntityToArrayMapper implements IProfileLanguageEntityToArrayMapper
{

    public function map(IProfileLanguageEntity $languageEntity): array
    {
      return [
          'language' => $languageEntity->getLanguage(),
          'country' =>  $languageEntity->getCountry(),
      ];
    }
}