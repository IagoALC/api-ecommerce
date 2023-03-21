<?php

namespace App\Repositories;

use App\Models\OrderDetails;
use App\Repositories\BaseRepository;

class OrderDetailsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'order_id',
        'country_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'zipcode'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OrderDetails::class;
    }
}
