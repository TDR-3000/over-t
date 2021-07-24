<?php

namespace App\Http\Controllers\States;

use App\Http\Controllers\AppController as Controller;
use Illuminate\Http\Request;
use App\Jobs\ResponseJobInterface;
use App\Repositories\RepositoryInterface;


final class IndexController extends Controller
{

    private $job;
    private $respository;

    public function __construct(ResponseJobInterface $job, RepositoryInterface $repository)
    {
        $this->job         = $job;
        $this->respository = $repository;
    }

    public function __invoke()
    {
        return $this->response($this->job->jsonStructure(200, false, $this->respository->getAll()), 200);
    }
}
