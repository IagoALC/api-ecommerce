<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Repositories\BaseRepository;

class CustomersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'status',
        'created_by',
        'updated_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Customers::class;
    }
}
