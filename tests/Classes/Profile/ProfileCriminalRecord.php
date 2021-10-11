<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property string $case_number
 * @property string $case_type
 * @property string $case_year
 * @property string $case_status
 * @property string $display
 */
class ProfileCriminalRecord extends Model implements IProfileCriminalRecordEntity,IProfileCriminalRecordRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'case_number',
      'case_type',
      'case_year',
      'case_status',
      'display',
    ];
    public function getProfileId(): int|string
    {
      return  $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
        $this->profile_id = $id;
    }

    public function setCaseNumber(string $caseNumber)
    {
       $this->case_number = $caseNumber;
    }

    public function getCaseNumber(): string
    {
        return $this->case_number;
    }

    public function setCaseType(string $caseType)
    {
        $this->case_type = $caseType;
    }

    public function getCaseType(): string
    {
        return $this->case_type;
    }

    public function setCaseYear(string $caseYear)
    {
        $this->case_year = $caseYear;
    }

    public function getCaseYear(): string
    {
        return $this->case_year;
    }

    public function setCaseStatus(string $caseStatus)
    {
       $this->case_status = $caseStatus;
    }

    public function getCaseStatus(): string
    {
       return $this->case_status;
    }

    public function setDisplay(string $display)
    {
      $this->display = $display;
    }

    public function getDisplay(): string
    {
       return $this->display;
    }

    public function saveEntity(IProfileCriminalRecordEntity|IEntity $entity): bool
    {
       return $entity->save();
    }

    public function createEntity(array $params = []): IProfileCriminalRecordEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
        // TODO: Implement deleteEntity() method.
    }
}
