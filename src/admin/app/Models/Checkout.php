<?php

namespace App\Models;

use App\Models\Model;

class Checkout extends Model
{
    protected $fillable = [
        'customer_id',
        'reference',
        'vehicle_type',
        'soap_type',
        'total_amount',
        'payment_type',
        'payment_status',
        'points',
        'ratio',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'points' => 'integer',
        'ratio' => 'integer',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
