<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->header('authorization'))) {
            throw new ApiException("No autorizado", 400);
        }

        if ($request->header('authorization') != $_ENV['API_KEY']) {
            throw new ApiException("No autorizado", 401);
        }

        return $next($request);
    }
}
