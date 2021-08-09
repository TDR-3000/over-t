<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\AppController as Controller;
use App\Helpers\{Json, Auth as Authorize};
use App\Repositories\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $response;
    private $auth;
    private $jwt;
    private $dependencies;

    public function __construct(Auth $auth, Authorize $jwt, Json $response)
    {
        $this->auth = $auth;
        $this->jwt  = $jwt;
        $this->response = $response;
        $this->dependencies = [
            "current" => 'login'
        ];
    }

    public function __invoke(Request $request)
    {
        $userAuth = $this->auth->login($request);
        return $this->response->jsonStructure(200, false, [
            "id" => $userAuth[0]["id"],
            "email" => $userAuth[0]["email"], 
            "token" => $this->auth($userAuth)
        ], $this->dependencies);
    }

    private function auth(array $user): string
    {
        return $this->jwt->signIn([
            $user[0]['id'],
            $user[0]['user_name'],
            $user[0]['email']
        ]);
    }
}
