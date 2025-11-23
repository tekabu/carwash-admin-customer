<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'balance',
        'points',
        'rfid',
    ];

    /**
     * Get the user that owns the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the customer.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
