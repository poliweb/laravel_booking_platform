<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Проверьте, аутентифицирован ли пользователь
        if (!Auth::check()) {
            abort(403, 'Access denied');
        }

        // Проверьте, соответствует ли роль пользователя требуемой роли
        if (Auth::user()->role !== $role) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}

