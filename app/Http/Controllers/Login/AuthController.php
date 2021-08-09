<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\AppController as Controller;
use App\Helpers\Json;
use App\Repositories\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request)
    {
        return $this->auth->login($request);
    }
}
