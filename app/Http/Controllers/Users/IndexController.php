<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use Illuminate\Http\Request;
use App\Jobs\Json;
use App\Repositories\Readable;

final class IndexController extends Controller
{

	private $response;
    private $respository;

    private $request;

    public function __construct(Json $response, Readable $repository, Request $request)
    {
        $this->response         = $response;
        $this->respository = $repository;
        $this->request     = $request;
    }

    public function __invoke()
    {
    	return $this->response($this->response->jsonStructure(200, false, $this->respository->getAll()), 200);
    }
}
