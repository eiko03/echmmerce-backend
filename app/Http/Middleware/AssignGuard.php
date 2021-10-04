<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssignGuard
{

    public function handle(Request $request, Closure $next, $guard = null)
    {

        if($guard != null)
            auth()->shouldUse($guard);
        else return response()->json(["message"=>"Unauthorized"]);
        return $next($request);

    }
}
