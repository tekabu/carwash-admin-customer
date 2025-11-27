<?php

namespace App\Models;

class CustomerFeedback extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}
