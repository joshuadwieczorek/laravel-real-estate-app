<?php

namespace App\Http\Middleware;
use App\Exceptions\UserAuthenticationException;
use App\Repositories\TokenRepository;
use App\Http\Responses\ApiResponse;
use Closure;

class ApiTokenValidator
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
    	$token = $request->header('Auth-Token');

    	if($token != null)
	    {
	    	$tokenRepo = new TokenRepository();
	    	if($tokenRepo->FindAndLogin($token))
			    return $next($request);
	    }

	    return response()->json(
		    (new ApiResponse([]))
			    ->ToArray('Unauthenticated request!', 401)
		    , 401
	    );
    }
}
