<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Search;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jawabkom\Backend\Module\Profile\Contract\ISearcherStatusEntity;
use Jawabkom\Backend\Module\Profile\Contract\ISearcherStatusRepository;
use Jawabkom\Standard\Contract\IEntity;


class SearcherStatus extends Model implements ISearcherStatusEntity,ISearcherStatusRepository
{

    protected $fillable=[
        'searcher_alias',
        'status_hour',
        'status_day',
        'status_month',
        'status_year',
        'counter',
    ];


    public function deleteEntity(IEntity $entity): bool
    {
        return (boolean)$entity->delete();
    }

    public function getSearcherAlias(): string
    {
        return $this->searcher_alias;
    }

    public function setSearcherAlias(string $alias)
    {
        $this->searcher_alias = $alias;
    }

    public function getStatusYear(): int
    {
        return $this->status_year;
    }

    public function setStatusYear(int $year)
    {
        $this->status_year = $year;
    }

    public function getStatusMonth(): int
    {
        return $this->status_month;
    }

    public function setStatusMonth(int $month)
    {
        $this->status_month = $month;
    }

    public function getStatusDay(): int
    {
        return $this->status_day;
    }

    public function setStatusDay(int $day)
    {
        $this->status_day = $day;
    }

    public function getStatusHour(): int
    {
        return $this->status_hour;
    }

    public function setStatusHour(int $hour)
    {
        $this->status_hour = $hour;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function setCounter(int $counter)
    {
        $this->counter = $counter;
    }

    public function saveEntity(ISearcherStatusEntity|IEntity $entity): bool
    {
        return $entity->save();
    }

    public function createEntity(array $params = []): ISearcherStatusEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function getSearcherRequestsCount(string $alias, int $year, int $month = 0, int $day = 0, ?int $hour = null):int
    {
        $builder = static::query();
        $builder->where('searcher_alias',$alias)->where('status_year',$year);
        if ($hour!=null)  $builder->where('status_hour',$hour);
        if ($day!=0)  $builder->where('status_day',$day);
        if ($month!=0)  $builder->where('status_month',$month);
        return  $builder->sum('counter');
    }

    public function increaseSearcherRequestsCount(string $alias, int $year, int $month, int $day, int $hour): void
    {
          $this->searcherQuery($alias , $year , $month , $day , $hour)->update([
                  'counter'=> DB::raw('counter+1')
              ]);
    }

    public function getSearcherRequests(string $alias, int $year, int $month, int $day, int $hour): ?ISearcherStatusEntity
    {
        return $this->searcherQuery($alias , $year , $month , $day , $hour)->first();
    }

    private function searcherQuery(string $alias, int $year, int $month, int $day, int $hour)
    {
        return $this->where('searcher_alias',$alias)->where('status_year',$year)
            ->where('status_hour',$hour)
            ->where('status_day',$day)
            ->where('status_month',$month);
    }
}
