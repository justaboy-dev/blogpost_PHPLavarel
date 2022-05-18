<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $route_name = $request->route()->getName();

        $route_arr = auth()->user()->role->permissions->toArray();

        foreach ($route_arr as $route) {
            if($route['name'] == $route_name && auth()->user()->status == 1){
                return $next($request);
            }
        }
        abort(403,'You have no permission to access this page');
    }
}
