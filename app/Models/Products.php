<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $table = 'products';

    public $fillable = [
        'title',
        'slug',
        'image',
        'image_mime',
        'image_size',
        'description',
        'status',
        'price',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'image' => 'string',
        'image_mime' => 'string',
        'description' => 'string',
        'status' => 'string'
    ];

    public static array $rules = [
        'title' => 'required|string|max:2000',
        'slug' => 'required|string|max:2000',
        'image' => 'nullable|string|max:2000',
        'image_mime' => 'nullable|string|max:255',
        'image_size' => 'nullable',
        'description' => 'nullable|string|max:65535',
        'status' => 'required|string|max:255',
        'price' => 'required',
        'created_by' => 'nullable',
        'updated_by' => 'nullable',
        'deleted_by' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function cartItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\CartItem::class, 'product_id');
    }

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'product_id');
    }
}
