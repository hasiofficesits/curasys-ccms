<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roleIds)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (!in_array(Auth::user()->role, $roleIds)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
