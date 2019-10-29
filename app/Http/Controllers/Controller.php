<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Throwable;
use Exception;
use App\Core\ResponseBase;
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

			if($didWork instanceof ResponseBase)
			{
				// Prepare the response.
				$didWork->Prepare();

				if(request()->wantsJson())
				{
					// Prepare the JSON data.
					$data = $this->_JsonData($didWork->Data(), $didWork->Message(), $didWork->StatusCode());

					// Return the JSON response.
					return response()
						->json($data, $didWork->StatusCode());
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
				    ->json($this->_JsonData([], 'Unauthenticated request!', 401), 401);

		    return redirect('/login');
	    }
	    catch (Throwable $exception)
	    {
	    	if(request()->wantsJson())
	    		return response()
				    ->json($this->_JsonData([], 'Internal server error!', 500), 500);

	    	return view('errors.500');
	    }
    }


	/**
	 * Prepare JSON data for API response.
	 *
	 * @param array $data
	 * @param string $message
	 * @param int $statusCode
	 *
	 * @return array
	 */
    private function _JsonData(?array $data, string $message, int $statusCode) : array
    {
    	return [
			'status' => $statusCode,
		    'message' => $message,
		    'data' => $data ?? []
	    ];
    }
}
