<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\AppController as Controller;
use App\Repositories\Readable;
use App\Helpers\Json;

class ShowController extends Controller
{

    private $repository;
    private $response;
    private $dependencies;

    public function __construct(Readable $repository, Json $response)
    {
        $this->repository = $repository;
        $this->response = $response;
        $this->dependencies = [
            "current" => 'tasks/',
            "dependencies" => [
                "users" => 'users',
                "categories_tasks" => 'categories_tasks'
            ]
        ];
    }

    public function __invoke(int $id)
    {
        return $this->response($this->response->jsonStructure(200, false, $this->repository->getOne($id), $this->dependencies), 200);
    }
}
