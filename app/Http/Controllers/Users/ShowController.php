<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use App\Helpers\Json;
use App\Repositories\Readable;

class ShowController extends Controller
{

	private $response;
    private $respository;
    private $dependencies;

    public function __construct(Json $response, Readable $repository)
    {
        $this->response    = $response;
        $this->respository = $repository;
        $this->dependencies = [
            'current' => 'users/',
            'dependencies' => [
                'states'
            ]
        ];
    }

    public function __invoke(int $id)
    {
    	return $this->response($this->response->jsonStructure(200, false, $this->respository->getOne($id), $this->dependencies), 200);
    }
}
