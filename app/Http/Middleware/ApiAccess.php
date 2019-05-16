<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Response;

class ApiAccess
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
        if ($request->route()->uri == 'api/register') return $next($request); // если маршрут на регистрацию, то не проверять токен
        if ($request->route()->uri == 'api/login') return $next($request); // если маршрут на регистрацию, то не проверять токен
        if ($request->route()->uri == 'api/check-session') return $next($request); // если маршрут на регистрацию, то не проверять токен

        $user = User::where('api_token', $request->api_token)->get();
        if (!$user->isEmpty())
            return $next($request);
        return response()->json('Unauthorization', 401);
    }
}
