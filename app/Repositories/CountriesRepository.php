<?php

namespace App\Repositories;

use App\Models\Countries;
use App\Repositories\BaseRepository;

class CountriesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'states'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Countries::class;
    }
}
