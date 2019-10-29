<?php

namespace App\Http\Middleware;
use App\Core\RequestValidatorBase;
use App\Http\Responses\ApiResponse;
use Closure;

class RequestDataValidator
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
	    if($request != null
	       && $request->route() != null
	       && $request->route()->action != null
	       && is_array($request->route()->action)
	       && isset($request->route()->action['data.validator']))
	    {
		    $dataValidatorClassNameString = $request->route()->action['data.validator'];
		    $classPath = "App\Validators\\$dataValidatorClassNameString";
		    if(class_exists($classPath))
		    {
			    $validator = new $classPath();
			    if($validator instanceof RequestValidatorBase)
			    {
					$validator->Validate($request);

				    if(!$validator->isValid)
				    {
					    if($request->wantsJson())
					    {
					    	$errors = $validator->validator->errors()->toArray();
					    	return response()->json(
							    (new ApiResponse($errors))
								    ->ToArray('Invalid request body!', 400)
							    , 400
						    );
					    }

					    return redirect()->back()
					                     ->withErrors($validator)
					                     ->withInput();
				    }
			    }
		    }
	    }

	    return $next($request);
    }
}
