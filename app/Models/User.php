<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $hidden = [
        "password"
    ];

    public function states()
    {
    	return $this->belongsTo(State::class, 'state_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
