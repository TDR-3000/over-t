<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function states()
    {
    	return $this->belongsTo(State::class, 'state_id');
    }
}