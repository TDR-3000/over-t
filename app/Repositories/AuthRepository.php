<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\Auth;
use App\Models\User;
use App\Exceptions\UserException;

class AuthRepository implements Auth
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request): array
    {
        $exists = $this->user->where('email', '=', $request->input('email'))
                    ->orWhere('user_name', '=', $request->input('user_name'))
                    ->select('user_name', 'email', 'password')
                    ->get()
                    ->makeVisible('password')
                    ->toArray();
        
        if (empty($exists)) {
            throw new UserException('email, nombre de usuario y/o clave incorrectos', 401);
        }

        return [];
    }
}