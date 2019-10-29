<?php

namespace App\Http\Middleware;

use Closure;

class AuthAttemptsExceeded
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
	    $loginAttemptsExceeded = $value = session('login_attempts_exceeded', false);
		if($loginAttemptsExceeded)
			return view('auth.unauthorized');

        return $next($request);
    }
}
