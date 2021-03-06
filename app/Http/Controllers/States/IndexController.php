<?php

namespace App\Http\Controllers\States;

use App\Http\Controllers\AppController as Controller;
use App\Helpers\Json;
use App\Repositories\Readable;

final class IndexController extends Controller
{

    private $response;
    private $respository;

    public function __construct(Json $response, Readable $repository)
    {
        $this->response     = $response;
        $this->respository  = $repository;
        $this->dependencies = [
            'current' => 'states/',
            'dependencies' => [
                'users'
            ]
        ];
    }

    public function __invoke()
    {
        return $this->response($this->response->jsonStructure(200, false, $this->respository->getAll(), $this->dependencies), 200);
    }
}
