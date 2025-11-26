<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model
{
    protected $route = 'customers';

    protected $appends = [
        'action_edit_url',
        'action_update_url',
        'action_delete_url',
        'action_add_balance_url',
        'action_update_balance_url',
        'action_options',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'rfid',
        'balance',
        'points',
    ];

    protected $casts = [
        'points' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActionAddBalanceUrlAttribute()
    {
        return route($this->route . '.showAddBalanceForm', $this->id);
    }

    public function getActionUpdateBalanceUrlAttribute()
    {
        return route($this->route . '.addBalance', $this->id);
    }

    public function getBalanceAttribute($value)
    {
        return number_format($value ?? 0, 2, '.', '');
    }
}
