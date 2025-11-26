<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Common;

class SoapType extends Model
{
    use HasFactory, Common;

    protected $route = 'soap-types';

    protected $appends = [
        'action_edit_url',
        'action_update_url',
        'action_delete_url',
        'action_options',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'soap_type',
        'sub_title',
        'image_url',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
