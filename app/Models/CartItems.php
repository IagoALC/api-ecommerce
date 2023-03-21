<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    public $table = 'cart_items';

    public $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'user_id' => 'required',
        'product_id' => 'required',
        'quantity' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
