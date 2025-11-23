<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Common;

class PackageType extends Model
{
    use HasFactory, Common;

    protected $route = 'package-types';

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
        'package_type',
    ];
}
