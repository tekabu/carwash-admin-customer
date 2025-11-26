<?php

namespace App\Models;

use App\Models\Model;

class Checkout extends Model
{
    protected $fillable = [
        'customer_id',
        'reference',
        'vehicle_type_id',
        'soap_type_id',
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

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function soapType()
    {
        return $this->belongsTo(SoapType::class);
    }
}
