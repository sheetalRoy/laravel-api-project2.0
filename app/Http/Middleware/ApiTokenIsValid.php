<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('api-token') == config('app.api-token')) {
            return $next($request);
        } else{
            return response()->json([
                'error' => 'Not Authorized',
                'status' => 401
            ]); 
        }
    }
}
