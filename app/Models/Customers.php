<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $table = 'customers';

    public $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'status' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:255',
        'created_by' => 'nullable',
        'updated_by' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function customerAddresses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CustomerAddress::class, 'customer_id');
    }
}
