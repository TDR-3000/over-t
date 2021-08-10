<?php

namespace App\Http\Middleware;

use App\Exceptions\JwtException;
use App\Helpers\Auth;
use Closure;

class AuthMiddleware
{
    private $jwt;

    public function __construct(Auth $jwt)
    {
        $this->jwt = $jwt;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->header('authentication'))) {
            throw new JwtException("No autorizado", 400);
        }

        $this->jwt->check($request->header('authentication'));
        
        return $next($request);
    }
}
