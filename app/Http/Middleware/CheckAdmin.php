<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class CheckAdmin
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
        $role = Role::where('name', 'Администратор')->get()->first()->id;
        if(!$request->user()->roles->contains($role))
            return redirect()->back()->withErrors('Доступ разрешен только админстратору!');
        return $next($request);
    }
}
