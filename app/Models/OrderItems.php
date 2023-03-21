<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    public $table = 'order_items';

    public $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price'
    ];

    protected $casts = [
        'quantity' => 'string'
    ];

    public static array $rules = [
        'order_id' => 'required',
        'product_id' => 'required',
        'quantity' => 'required|string|max:255',
        'unit_price' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
