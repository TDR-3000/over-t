<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use App\Jobs\Json;
use App\Repositories\Readable;

final class IndexController extends Controller
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

    public function __invoke()
    {
    	return $this->response($this->response->jsonStructure(200, false, $this->respository->getAll(), $this->dependencies), 200);
    }
}
