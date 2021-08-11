<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function users()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
