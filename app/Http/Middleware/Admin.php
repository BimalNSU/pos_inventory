<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\constant\userRoles;

$ROLES = [
    "admin" => 1,
    "manager" => 2,
    "salesman" => 3
];
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(Auth::user()->role == $ROLES['admin'])
        {
            return $next($request);
        }
        if(Auth::user()->role == $ROLES['manager'])
        {
            return redirect()->route('manager');
        }
        if(Auth::user()->role == $ROLES['salesman'])
        {
            return redirect()->route('salesman');
        }
    }
}
