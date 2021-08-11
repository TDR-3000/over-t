<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieTask extends Model
{
    protected $table = 'categories_tasks';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
