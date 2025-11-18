<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = [
        'logo',
        'site_name',
        'phone',
        'email',
        'address',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
