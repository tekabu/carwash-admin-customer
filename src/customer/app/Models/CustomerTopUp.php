<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerTopUp extends Model
{
    protected $fillable = [
        'customer_id',
        'proof_of_payment',
        'top_up_amount',
        'status',
        'remarks',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
