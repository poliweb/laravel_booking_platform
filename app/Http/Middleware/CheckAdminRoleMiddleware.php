<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return abort(403, 'Доступ запрещён');

        // if (!auth()->check() || auth()->user()->role !== 'admin') {
        //     return redirect('/');
        //     // abort(403);
        //     // или redirect() если хотите перенаправить
        // }

        return $next($request);
    }
}
