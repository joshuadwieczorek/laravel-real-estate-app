<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Throwable;
use Exception;
use App\Core\ResponseBase;
use App\Http\Responses\ApiResponse;
use App\Exceptions\UserAuthenticationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	/**
	 * Return the correct response based on the request type.
	 *
	 * @param callable $work
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
    protected function Response(callable $work)
    {
    	try
	    {
	    	// Process the data.
			$didWork = $work();

			if($didWork == null && request()->wantsJson())
				return response(null, 204);

			if($didWork instanceof ResponseBase)
			{
				// Prepare the response.
				$didWork->Prepare();

				if(request()->wantsJson())
				{
					// Return the JSON response.
					return response()
						->json(
							(new ApiResponse($didWork->Data()))
								->ToArray($didWork->Message(), $didWork->StatusCode())
							, $didWork->StatusCode()
						);
				}

				// Otherwise return the view.
				return view($didWork->View(), $didWork->Data());
			}
			else
				throw new Exception('Invalid response type from the $work() callback!');

	    }
	    catch (UserAuthenticationException $exception)
	    {
		    if(request()->wantsJson())
			    return response()
				    ->json(
				    	(new ApiResponse([]))
					        ->ToArray('Unauthenticated request!', 401)
				    );

		    return redirect('/login');
	    }
	    catch (Throwable $exception)
	    {
	    	dd($exception->getMessage());
	    	if(request()->wantsJson())
	    		return response()
				    ->json(
					    (new ApiResponse([]))
						    ->ToArray('Internal server error!', 500)
		                    , 500
				    );

	    	return view('errors.500');
	    }
    }
}
