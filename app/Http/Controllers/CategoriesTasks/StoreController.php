<?php

namespace App\Http\Controllers\CategoriesTasks;

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
            'current' => 'categories-tasks'
        ];
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|max:45',
            'description' => 'required|max:255'  
        ]);

        return $this->response($this->response->jsonStructure(201, false, $this->repository->store($request), $this->dependencies), 201);
    }
}
