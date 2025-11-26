<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class TelescopeBasicAuth
{
    /**
     * Require an authenticated session before accessing Telescope.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('telescope.enabled')) {
            return $next($request);
        }

        $guard = env('TELESCOPE_AUTH_GUARD', config('auth.defaults.guard'));
        $auth = $guard ? Auth::guard($guard) : Auth::guard();

        if ($auth->check()) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            abort(401);
        }

        $loginRoute = env('TELESCOPE_LOGIN_ROUTE', 'login');
        $destination = Route::has($loginRoute) ? route($loginRoute) : url('/login');

        return redirect()->guest($destination);
    }
}
