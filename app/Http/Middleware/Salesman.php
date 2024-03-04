<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
$ROLES = [
    "admin" => 1,
    "manager" => 2,
    "salesman" => 3
];
class Salesman
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
            return redirect()->route('admin');
        }
        if(Auth::user()->role == $ROLES['manager'])
        {
            return redirect()->route('manager');
        }
        if(Auth::user()->role == $ROLES['salesman'])
        {
            return $next($request);
        }
    }
}
