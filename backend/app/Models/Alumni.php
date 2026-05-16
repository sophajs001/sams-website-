<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni'; // 👈 Add this line

    protected $fillable = [
        'name',
        'ordination_date',
        'role',
        'bio',
    ];
}
