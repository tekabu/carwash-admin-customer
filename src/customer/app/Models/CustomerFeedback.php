<?php

namespace App\Models;

class CustomerFeedback extends Model
{
    /**
     * Explicitly define table name to avoid singularization issues.
     */
    protected $table = 'customer_feedbacks';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}

