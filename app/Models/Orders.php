<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $table = 'orders';

    public $fillable = [
        'total_price',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public static array $rules = [
        'total_price' => 'required',
        'status' => 'required|string|max:255',
        'created_by' => 'nullable',
        'updated_by' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function orderDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderDetail::class, 'order_id');
    }

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Payment::class, 'order_id');
    }
}
