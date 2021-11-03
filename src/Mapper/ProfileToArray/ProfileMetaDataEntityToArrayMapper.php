<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileMetaDataEntityToArrayMapper;

class ProfileMetaDataEntityToArrayMapper implements IProfileMetaDataEntityToArrayMapper
{

    public function map(IProfileMetaDataEntity $metaDataEntity): array
    {
       return  [
           'meta_key'   => $metaDataEntity->getMetaKey(),
           'meta_value' => $metaDataEntity->getMetaValue(),
       ];
    }
}
