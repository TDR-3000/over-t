<?php
namespace App\Repositories;

use App\Repositories\Readable;
use App\Models\CategorieTask;

class CategorieTaskRepository implements Readable
{

    private $categorieTask;

    public function __construct(CategorieTask $categorieTask)
    {
        $this->categorieTask = $categorieTask;
    }

    public function getAll(): array
    {
        return $this->categorieTask->with(['tasks' => function ($query) {
			return $query->select('id', 'task', 'categorie_task_id');
		}])->get()->toArray();
    }

    public function getOne(int $id): array
    {
        return [];
    }
}