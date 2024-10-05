<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'candidate_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function candidates()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
