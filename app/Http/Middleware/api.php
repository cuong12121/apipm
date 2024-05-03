<?php

namespace App\Http\Middleware;

use Closure;

class api
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
        $token = $request->header('token');

        if($token != 'eecc19a1cabb51a5080f6f56399f7e82'){

            return response()->json(['message'=> 'token not found'], 401);
        }
        return $next($request);
    }
}
