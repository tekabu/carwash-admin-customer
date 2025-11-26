<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'is_guest',
        'customer_id',
        'vehicle_type_id',
        'soap_type_id',
        'customer_name',
        'vehicle_type',
        'vehicle_type_amount',
        'soap_type',
        'soap_type_amount',
        'total_amount',
        'current_balance',
        'new_balance',
        'current_points',
        'new_points',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_guest' => 'boolean',
            'vehicle_type_amount' => 'decimal:2',
            'soap_type_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'current_balance' => 'decimal:2',
            'new_balance' => 'decimal:2',
            'current_points' => 'decimal:4',
            'new_points' => 'decimal:4',
        ];
    }

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
     * Get the soap type associated with the transaction.
     */
    public function soapType()
    {
        return $this->belongsTo(SoapType::class);
    }
}
