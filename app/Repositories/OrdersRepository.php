<?php

namespace App\Repositories;

use App\Models\Orders;
use App\Repositories\BaseRepository;

class OrdersRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'total_price',
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
        return Orders::class;
    }
}
