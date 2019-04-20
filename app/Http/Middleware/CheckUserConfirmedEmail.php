<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserConfirmedEmail
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
        if($request->user()->confirmedEmail()) {
            return redirect()->back()->with('warning', 'Ваш E-mail уже подтвержден!');
        }

        return $next($request);
    }
}
