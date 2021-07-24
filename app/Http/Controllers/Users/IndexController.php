<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\AppController as Controller;
use Illuminate\Http\Request;
use App\Jobs\ResponseJobInterface;
use App\Repositories\RepositoryInterface;

class IndexController extends Controller
{

	private $job;
    private $respository;

    private $request;

    public function __construct(ResponseJobInterface $job, RepositoryInterface $repository, Request $request)
    {
        $this->job         = $job;
        $this->respository = $repository;
        $this->request     = $request;
    }

    public function __invoke()
    {
        //dd($this->request);
    	return $this->response($this->job->jsonStructure(200, false, $this->respository->getAll()), 200);
    }
}
