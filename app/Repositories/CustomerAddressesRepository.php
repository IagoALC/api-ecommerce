<?php

namespace App\Repositories;

use App\Models\CustomerAddresses;
use App\Repositories\BaseRepository;

class CustomerAddressesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'country_code',
        'customer_id',
        'type',
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
        return CustomerAddresses::class;
    }
}
