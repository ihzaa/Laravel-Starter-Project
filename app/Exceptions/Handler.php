<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        // if ($request->expectsJson()) {
        //     return response()->json(['error' => 'Unauthenticated.'], 401);
        // }

        // return redirect('/login');
        // $guard = Arr::get($exception->guards(), 0);
        // switch ($guard) {
        //     case 'admin':
        //         // $login = route('admin.auth.login.get');
        //         $login = route('auth.login.get');
        //         break;
        //     case 'prodi':
        //         session()->flash('guard', 'prodi');
        //         $login = route('auth.login.get');
        //         break;
        //     case 'mahasiswa':
        //         $login = route('siswa.loginGet');
        //         break;
        // }

        $login = route('auth.login.get');

        return $request->expectsJson()
            ? response()->json([
                'message' => $exception->getMessage(),
                'auth_url' => $login,
                'staus'    => false
            ], 401)
            : redirect()->guest($login);
    }
}
