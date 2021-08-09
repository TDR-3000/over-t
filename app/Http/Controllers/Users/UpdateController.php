<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use App\Helpers\Json;
use App\Repositories\Writetable;
use Illuminate\Http\Request;

class UpdateController extends Controller
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
    
    public function __invoke(Request $request, int $id)
    {
        $this->validate($request, [
            'user_name' => 'nullable|max:45',
            'first_name' => 'nullable|max:45',
            'second_name' => 'nullable|max:45',
            'first_last_name' => 'nullable|max:45',
            'second_last_name' => 'nullable|max:45',
            'email' => 'nullable|email',
            'cellphone' => 'nullable|max:12',
            'password' => 'nullable|max:125',
            'state_id' => 'nullable|integer'    
        ]);

        return $this->response($this->response->jsonStructure(200, false, $this->repository->update($request, $id), $this->dependencies), 200);
    }
}
