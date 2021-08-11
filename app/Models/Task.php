<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function users()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function categoriesTasks()
    {
        return $this->belongsTo(CategorieTask::class, 'categorie_task_id');
    }
}
