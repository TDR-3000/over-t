<?php
namespace App\Repositories;

use App\Exceptions\CategorieTaskException;
use App\Repositories\{Readable, Writetable};
use App\Models\CategorieTask;
use Illuminate\Http\Request;

class CategorieTaskRepository implements Readable, Writetable
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
		}])->where('status', 1)->get()->toArray();
    }

    public function getOne(int $id): array
    {
        $record = $this->categorieTask->with(['tasks' => function ($query) {
			return $query->select('id', 'task', 'categorie_task_id');
		}])->where('id', $id)->where('status', 1)->get()->toArray();

        if (empty($record)) {
			throw new CategorieTaskException('El registro no existe', 404);
		}

		return $record;
    }

    public function store(Request $request): array
    {
        $data = $request->all();
		array_walk($data, function ($value, $key) use ($request) {
			$this->categorieTask->$key = $request->input($key);
		});
		$response = $this->categorieTask->save();

        if (!$response) {
            throw new CategorieTaskException('Ha ocurrido un error', 500);
        }

		return [
			"id" => $this->categorieTask->id,
			"user_name" => $this->categorieTask->category
		];
    }

    public function update(Request $request, int $id): array
    {
        return [];
    }

    public function delete(int $id): array
    {
        $record = $this->categorieTask->find($id);

		if ($record === null) {
			throw new CategorieTaskException('El registro no existe', 404);
		}

		$response = $record->delete();

		if (!$response) {
            throw new CategorieTaskException('Ha ocurrido un error', 500);
        }

		return [
            "id" => $record->id,
            "message" => "Elminado"
        ];
    }
}