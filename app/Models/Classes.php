<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_user',
        'session_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function votingSession()
    {
        return $this->belongsTo(VotingSession::class, 'session_id');
    }
}
