<?php

namespace App\Repositories;

use App\Models\OrderItems;
use App\Repositories\BaseRepository;

class OrderItemsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OrderItems::class;
    }
}
