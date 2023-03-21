<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $table = 'order_details';

    public $fillable = [
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

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'address1' => 'string',
        'address2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zipcode' => 'string'
    ];

    public static array $rules = [
        'order_id' => 'required',
        'country_code' => 'required',
        'first_name' => 'required|string|max:45',
        'last_name' => 'required|string|max:45',
        'email' => 'required|string|max:45',
        'phone' => 'nullable|string|max:45',
        'address1' => 'required|string|max:45',
        'address2' => 'required|string|max:45',
        'city' => 'required|string|max:45',
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

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
