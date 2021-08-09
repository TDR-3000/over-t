<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\{Auth, UserRepository};
use App\Helpers\Auth as Authorize;
use App\Exceptions\UserException;

class AuthRepository implements Auth
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function login(Request $request): array
    {
        $user = $this->user->byEmailAndUserName($request->input('email'), $request->input('user_name'));
        
        if (empty($user)) {
            throw new UserException('email, nombre de usuario y/o clave incorrectos', 401);
        }

        $check = $this->checkPassword($request->input('password'), $user[0]['password']);

        if (!$check) {
            throw new UserException('email, nombre de usuario y/o clave incorrectos', 401);
        }

        return $user;
    }

    private function checkPassword(string $passwordRequest, string $password)
    {
        return (password_verify($passwordRequest, $password)) ? true : false;
    }
}