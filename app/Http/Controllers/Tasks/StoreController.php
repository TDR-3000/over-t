<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\AppController as Controller;
use App\Repositories\Writetable;
use App\Helpers\Json;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $response;
    private $repository;
    private $dependencies;

    public function __construct(Writetable $repository, Json $response)
    {
        $this->repository = $repository;
        $this->response = $response;
        $this->dependencies = [
            'current' => 'tasks'
        ];
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'task' => 'required|max:45', 
            'description' => 'required|max:255',
            'status' => 'required|integer',
            'priority' => 'required|integer',
            "dead_line" => 'required',
            'user_id' => 'required|integer', 
            'categorie_task_id' => 'required|integer'
        ]);

        return $this->response($this->response->jsonStructure(201, false, $this->repository->store($request), $this->dependencies), 201);
    }
}
