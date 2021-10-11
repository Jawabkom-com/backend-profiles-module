<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property string $language
 * @property string $country
 */
class ProfileLanguage extends Model implements IProfileLanguageEntity,IProfileLanguageRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'language',
      'country',
    ];
    public function getProfileId(): int|string
    {
     return  $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
       $this->profile_id = $id;
    }

    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return  $this->country;
    }

    public function saveEntity(IProfileLanguageEntity|IEntity $entity): bool
    {
      return  $entity->save();
    }

    public function createEntity(array $params = []): IProfileLanguageEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
        // TODO: Implement deleteEntity() method.
    }
}
