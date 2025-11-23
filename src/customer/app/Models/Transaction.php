<?php

namespace App\Models;

use App\Models\Model;

class Transaction extends Model
{
    /**
     * Get the customer associated with the transaction.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the vehicle type associated with the transaction.
     */
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * Get the package type associated with the transaction.
     */
    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }
}
