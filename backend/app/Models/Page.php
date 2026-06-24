<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'section',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'featured_image',
        'status',
        'is_homepage',
        'is_system',
        'sort_order',
    ];

    protected $casts = [
        'is_homepage' => 'boolean',
        'is_system' => 'boolean',
        'sort_order' => 'integer',
    ];

    public const SECTIONS = [
        'main' => 'Main',
        'about' => 'About Us',
        'academics' => 'Academics',
        'resources' => 'Resources',
        'info' => 'Info',
        'community' => 'Community',
    ];
}
