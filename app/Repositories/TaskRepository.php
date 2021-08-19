<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Repositories\{Readable, Writetable};
use App\Exceptions\TaskException;

class TaskRepository implements Readable, Writetable
{

    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getAll(): array
    {
        return $this->task->with(['users' => function ($query) {
            return $query->select('id', 'user_name', 'email');
        }])->with(['categoriesTasks' => function ($query) {
            return $query->select('id', 'category');
        }])->where('status', 1)->get()->toArray();
    }

    public function getOne(int $id): array
    {
        $record = $this->task->with(['users' => function ($query) {
            return $query->select('id', 'user_name', 'email');
        }])->with(['categoriesTasks' => function ($query) {
            return $query->select('id', 'category');
        }])->where('id', $id)->where('status', 1)->get()->toArray();

        if (empty($record)) {
			throw new TaskException('El registro no existe', 404);
		}

		return $record;
    }

    public function store(Request $request): array
    {
        $data = $request->all();
		array_walk($data, function ($value, $key) use ($request) {
			$this->task->$key = $request->input($key);
		});
		$response = $this->task->save();

        if (!$response) {
            throw new TaskException('Ha ocurrido un error', 500);
        }

		return [
			"id" => $this->task->id,
			"task" => $this->task->task
		];
    }

    public function update(Request $request, int $id): array
    {
        $record = $this->task->find($id);

		if ($record === null) {
			throw new TaskException('El registro no existe', 404);
		}

		$data = $request->all();

		array_walk($data, function ($value, $key) use ($record, $request) {
			$record->$key = (!empty($request->input($key))) ? $request->input($key) : $record->$key;
		});

		$response = $record->save();

        if (!$response) {
            throw new TaskException('Ha ocurrido un error', 500);
        }

		return [
			"id" => $record->id,
			"task" => $record->task
		];
    }

    public function delete(int $id): array
    {
        $record = $this->task->find($id);

		if ($record === null) {
			throw new TaskException('El registro no existe', 404);
		}

		$response = $record->delete();

		if (!$response) {
            throw new TaskException('Ha ocurrido un error', 500);
        }

		return [
            "id" => $record->id,
            "message" => "Elminado"
        ];
    }
}