<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use App\Jobs\Json;
use App\Repositories\Writetable;

class DeleteController extends Controller
{

    private $repository;
    private $response;
    private $dependencies;

    public function __construct(Json $response, Writetable $repository)
    {
        $this->response   = $response;
        $this->repository = $repository;
        $this->dependencies = [
            'current' => 'users/'
        ];
    }

    public function __invoke(int $id)
    {
        return $this->response($this->response->jsonStructure(200, false, $this->repository->delete($id), $this->dependencies), 200);
    }
}
