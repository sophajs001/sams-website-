<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'footer_text',
        'contact_email',
        'contact_phone',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
