<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use App\Helpers\Json;
use App\Repositories\Writetable;
use Illuminate\Http\Request;

final class StoreController extends Controller
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
        $this->validate($request, [
            'user_name' => 'required|max:45',
            'first_name' => 'required|max:45',
            'second_name' => 'nullable|max:45',
            'first_last_name' => 'required|max:45',
            'second_last_name' => 'nullable|max:45',
            'email' => 'required|email|unique:users',
            'cellphone' => 'nullable|max:12',
            'password' => 'required|max:125',
            'state_id' => 'required|integer'    
        ]);

        return $this->response($this->response->jsonStructure(201, false, $this->repository->store($request), $this->dependencies), 201);
    }
}
