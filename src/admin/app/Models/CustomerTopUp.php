<?php

namespace App\Models;

use App\Models\Traits\Common;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CustomerTopUp extends Model
{
    use Common {
        getActionOptionsAttribute as getCommonActionOptionsAttribute;
    }

    protected $route = 'customer-top-ups';

    protected $appends = [
        'action_edit_url',
        'action_update_url',
        'action_delete_url',
        'action_options',
        'proof_of_payment_url',
    ];

    protected $fillable = [
        'customer_id',
        'proof_of_payment',
        'top_up_amount',
        'status',
        'remarks',
    ];

    public function getActionOptionsAttribute()
    {
        if ($this->status === 'Approved') {
            return '';
        }

        return $this->getCommonActionOptionsAttribute();
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getProofOfPaymentUrlAttribute(): ?string
    {
        if (empty($this->proof_of_payment)) {
            return null;
        }

        return Storage::url($this->proof_of_payment);
    }

    public function creditCustomerBalance(float $amount = null): void
    {
        $amount ??= $this->top_up_amount;

        if ($amount === null || $amount <= 0) {
            return;
        }

        $this->customer()->increment('balance', $amount);
    }
}
