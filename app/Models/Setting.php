<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'instansi',
        'author',
        'description',
        'keywords',
        'open',
        'close',
    ];

    protected $casts = [
        'open' => 'datetime',
        'close' => 'datetime',
    ];
}
