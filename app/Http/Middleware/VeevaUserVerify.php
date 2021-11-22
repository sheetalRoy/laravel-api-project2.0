<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Logintrack;

class VeevaUserVerify
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
        // $res = Logintrack::where('veeva_id','=',$veeva_id)->first();
        $login = DB::table('logintracks')
        ->where('veeva_id', '=', $request->header('veeva-id'))
        ->where('active', '=', '1')
        ->first();
       if ($login == null) {
        return response()->json([
            'error' => 'Not Authorized',
            'status' => 401
        ]); 
       }

        return $next($request);
    }
}

