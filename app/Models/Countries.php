<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    public $table = 'countries';

    public $fillable = [
        'name',
        'states'
    ];

    protected $casts = [
        'name' => 'string',
        'states' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'states' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function customerAddresses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CustomerAddress::class, 'country_code');
    }

    public function orderDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderDetail::class, 'country_code');
    }
}
