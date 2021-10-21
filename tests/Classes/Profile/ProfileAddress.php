<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $street
 * @property string $building_number
 * @property string $display
 */
class ProfileAddress extends Model implements IProfileAddressEntity,IProfileAddressRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'valid_since',
      'country',
      'state',
      'city',
      'zip',
      'street',
      'building_number',
      'display',
    ];
    protected $hidden =[
        'id',
        'profile_id',
        'created_at',
        'updated_at',
    ];
    public function getProfileId(): int|string
    {
       return $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
        $this->profile_id = $id;
    }

    public function setValidSince(\DateTime $validSince)
    {
        $this->valid_since = $validSince;
    }

    public function getValidSince(): \DateTime
    {
       return $this->valid_since;
    }

    public function setCountry(string $country)
    {
       $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setState(string $state)
    {
       $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setCity(string $city)
    {
       $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setZip(string $zip)
    {
       $this->zip = $zip;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setStreet(string $street)
    {
       $this->street = $street;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setBuildingNumber(string $buildingNumber)
    {
       $this->building_number = $buildingNumber;
    }

    public function getBuildingNumber(): string
    {
        return $this->building_number;
    }

    public function setDisplay(string $display)
    {
       $this->display = $display;
    }

    public function getDisplay(): string
    {
        return $this->display;
    }

    public function saveEntity(IProfileAddressEntity|IEntity $entity): bool
    {
       return $entity->save();
    }

    public function createEntity(array $params = []): IProfileAddressEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function deleteEntity(IEntity $entity): bool
    {
        return $entity->delete();
    }

    public function getByProfileId(): iterable
    {
      // $this->
    }
}
