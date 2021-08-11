<?php

namespace App\Http\Controllers\CategoriesTasks;

use App\Http\Controllers\AppController as Controller;
use App\Repositories\Readable;
use App\Helpers\Json;

final class IndexController extends Controller
{

    private $repository;
    private $response;
    private $dependencies;

    public function __construct(Readable $repository, Json $response)
    {
        $this->repository = $repository;
        $this->response = $response;
        $this->dependencies = [
            "current" => 'categories-tasks/',
            "dependencies" => [
                'tasks'
            ]
        ];
    }

    public function __invoke()
    {
        return $this->response->jsonStructure(200, false, $this->repository->getAll(), $this->dependencies);
    }
}
