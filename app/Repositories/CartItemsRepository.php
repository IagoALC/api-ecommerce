<?php

namespace App\Repositories;

use App\Models\CartItems;
use App\Repositories\BaseRepository;

class CartItemsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return CartItems::class;
    }
}
