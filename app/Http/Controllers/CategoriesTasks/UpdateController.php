<?php

namespace App\Http\Controllers\CategoriesTasks;

use App\Http\Controllers\AppController as Controller;
use App\Repositories\Writetable;
use App\Helpers\Json;
use Illuminate\Http\Request;

class UpdateController extends Controller
{

    private $repository;
    private $response;
    private $dependencies;

    public function __construct(Writetable $repository, Json $response)
    {
        $this->repository = $repository;
        $this->response = $response;
        $this->dependencies = [
            'current' => 'categories-tasks/'
        ];
    }

    public function __invoke(Request $request, int $id)
    {
        return $this->response($this->response->jsonStructure(200, false, $this->repository->update($request, $id), $this->dependencies), 200);
    }
}
