<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCustomAuth
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
        if ($request->header('veeva-api') == config('app.veeva-api')) {
            return $next($request);
        } else{
            // $msg['error'] =  'Not Authorised';
            return response()->json([
                'error' => 'Not Authorized',
                'status' => 401
            ]); 
        }
        
    }
}
