<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return route('admin.auth.login.get');
        // }

        if (Auth::guard('admin')->check()) {
            return redirect(route('admin.dashboard.index'));
        }
        // else if (Auth::guard('user')->check()) {

        //     return redirect('/user');
        // }
    }
}
