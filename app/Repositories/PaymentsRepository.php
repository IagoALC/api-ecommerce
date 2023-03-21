<?php

namespace App\Repositories;

use App\Models\Payments;
use App\Repositories\BaseRepository;

class PaymentsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'order_id',
        'amount',
        'status',
        'type',
        'created_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Payments::class;
    }
}
