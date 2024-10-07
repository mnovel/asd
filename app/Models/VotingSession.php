<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class VotingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'open',
        'close'
    ];

    public function class()
    {
        return $this->hasMany(Classes::class, 'session_id');
    }
}
