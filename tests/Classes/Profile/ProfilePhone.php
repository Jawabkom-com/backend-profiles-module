<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property string $type
 * @property bool $do_not_call_flag
 * @property string $country_code
 * @property string $original_number
 * @property string $formatted_number
 * @property bool $valid_phone
 * @property bool $risky_phone
 * @property bool $disposable_phone
 * @property string $carrier
 * @property string $purpose
 * @property string $industry
 */
class ProfilePhone extends Model implements IProfilePhoneEntity,IProfilePhoneRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'type',
      'do_not_call_flag',
      'country_code',
      'original_number',
      'formatted_number',
      'valid_phone',
      'risky_phone',
      'disposable_phone',
      'carrier',
      'purpose',
      'industry',
    ];
    public function getProfileId(): int|string
    {
       return $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
       $this->profile_id = $id;
    }

    public function getCreatedAt(): \DateTime
    {
      return  $this->created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function setType(string $type)
    {
     $this->type = $type;
    }

    public function getType(): string
    {
       return $this->type;
    }

    public function setDoNotCallFlag(bool $doNotCallFlag)
    {
       $this->do_not_call_flag = $doNotCallFlag;
    }

    public function getDoNotCallFlag(): bool
    {
        return $this->do_not_call_flag;
    }

    public function setCountryCode(string $countryCode)
    {
       $this->country_code = $countryCode;
    }

    public function getCountryCode(): string
    {
       return $this->country_code;
    }

    public function setOriginalNumber(string $originalNumber)
    {
        $this->original_number = $originalNumber;
    }

    public function getOriginalNumber(): string
    {
        return $this->original_number;
    }

    public function setFormattedNumber(string $formattedNumber)
    {
      $this->formatted_number = $formattedNumber;
    }

    public function getFormattedNumber(): string
    {
     return $this->formatted_number;
    }

    public function setValidPhone(bool $validPhone)
    {
       $this->valid_phone = $validPhone;
    }

    public function getValidPhone(): bool
    {
       return $this->valid_phone;
    }

    public function setRiskyPhone(bool $riskyPhone)
    {
        $this->risky_phone = $riskyPhone;
    }

    public function getRiskyPhone(): bool
    {
      return  $this->risky_phone;
    }

    public function setDisposablePhone(bool $disposablePhone)
    {
       $this->disposable_phone = $disposablePhone;
    }

    public function getDisposablePhone(): bool
    {
        return $this->disposable_phone;
    }

    public function setCarrier(string $carrier)
    {
       $this->carrier = $carrier;
    }

    public function getCarrier(): string
    {
      return $this->carrier;
    }

    public function setPurpose(string $purpose)
    {
      $this->purpose = $purpose;
    }

    public function getPurpose(): string
    {
        return  $this->purpose;
    }

    public function setIndustry(string $industry)
    {
        $this->industry = $industry;
    }

    public function getIndustry(): string
    {
       return $this->industry;
    }

    public function saveEntity(IEntity|IProfilePhoneEntity $entity): bool
    {
       return  $entity->save();
    }

    public function createEntity(array $params = []): IProfilePhoneEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
       return $entity->delete();
    }
}
