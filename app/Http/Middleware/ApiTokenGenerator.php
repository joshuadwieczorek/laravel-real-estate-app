<?php

namespace App\Http\Middleware;
use App\Repositories\TokenRepository;
use Closure;

class ApiTokenGenerator
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
		$tokenRepo = new TokenRepository();

		if(!$tokenRepo->Exists())
			$tokenRepo->Create();

		elseif($tokenRepo->IsExpired())
			$tokenRepo->Expire();

        return $next($request);
    }
}
