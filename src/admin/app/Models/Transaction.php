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
        'package_type_id',
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
     * Get the package type associated with the transaction.
     */
    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }
}
