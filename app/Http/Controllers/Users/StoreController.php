<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use App\Jobs\Json;
use App\Repositories\Writetable;
use Illuminate\Http\Request;

class StoreController extends Controller
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

    public function __invoke(Request $request)
    {
        return $this->response($this->response->jsonStructure(201, false, $this->repository->store($request), $this->dependencies), 201);
    }
}
