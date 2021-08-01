<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $userRoles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $userRoles)
    {
        if(!in_array(Auth::user()->level, explode('|', $userRoles), true)){
            abort(403);
        }

        return $next($request);
    }
}
