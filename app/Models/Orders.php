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
        'created_by' => 'required',
        'updated_by' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
