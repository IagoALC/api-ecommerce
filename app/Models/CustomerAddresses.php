<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddresses extends Model
{
    public $table = 'customer_addresses';

    public $fillable = [
        'country_code',
        'customer_id',
        'type',
        'address1',
        'address2',
        'city',
        'state',
        'zipcode'
    ];

    protected $casts = [
        'type' => 'string',
        'address1' => 'string',
        'address2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zipcode' => 'string'
    ];

    public static array $rules = [
        'country_code' => 'required',
        'customer_id' => 'required',
        'type' => 'required|string|max:45',
        'address1' => 'required|string|max:255',
        'address2' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'nullable|string|max:45',
        'zipcode' => 'required|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function countryCode(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_code');
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }
}
