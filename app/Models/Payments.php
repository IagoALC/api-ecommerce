<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $table = 'payments';

    public $fillable = [
        'order_id',
        'amount',
        'status',
        'type',
        'created_by'
    ];

    protected $casts = [
        'status' => 'string',
        'type' => 'string'
    ];

    public static array $rules = [
        'order_id' => 'required',
        'amount' => 'required',
        'status' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'created_by' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
