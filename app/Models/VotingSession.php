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
        'class',
        'open',
        'close'
    ];

    /**
     * Get the classes related to the voting session.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function classes()
    {
        $classIds = is_array($this->class) ? $this->class : json_decode($this->class, true);
        return Classes::whereIn('id', $classIds)->get();
    }

    /**
     * Set the class attribute to store as JSON.
     *
     * @param array $value
     * @return void
     */
    public function setClassAttribute($value)
    {
        $this->attributes['class'] = json_encode($value);
    }

    /**
     * Get the class attribute as an array.
     *
     * @return array
     */
    public function getClassAttribute($value)
    {
        return json_decode($value, true);
    }
}
