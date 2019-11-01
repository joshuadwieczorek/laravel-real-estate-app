<?php

namespace App\Http\Controllers\Api;
use App\Exceptions\UserAuthorizationException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ListingResponse;
use App\Http\Responses\ListingsResponse;
use Illuminate\Http\Request;
use App\Contracts\ServiceProviders\ListingsServiceProviderContract;
use Illuminate\Support\Facades\Gate;

class ListingsController extends Controller
{
	/**
	 * Listings service provider.
	 *
	 * @var ListingsServiceProviderContract
	 */
	private $_listingProvider;


	/**
	 * ListingsController constructor.
	 *
	 * @param ListingsServiceProviderContract $listingProvider
	 */
	public function __construct(ListingsServiceProviderContract $listingProvider)
	{
		$this->_listingProvider = $listingProvider;
	}


	/**
	 * GET : /api/listings
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function get(Request $request)
	{
		return $this->Response(function() use($request) {
			$data = $this->_listingProvider->Get();
			return new ListingsResponse($data);
		});
	}


	/**
	 * GET : /api/listings
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function all(Request $request)
	{
		return $this->Response(function() use($request)
		{
			if(Gate::allows('user-admin'))
			{
				$data = $this->_listingProvider->GetAll();
				return new ListingsResponse($data);
			}

			throw new UserAuthorizationException('Unauthenticated request!');
		});
	}


	/**
	 * View : /api/listings/{id}
	 * GET : /api/listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function getSingle(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id) {
			$data = $this->_listingProvider->GetSingle($id);
			return new ListingResponse($data);
		});
	}


	/**
	 * POST : /api/listings
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function create(Request $request)
	{
		return $this->Response(function() use($request)
		{
			if(Gate::allows('user-admin'))
			{
				$model = $request->request->get('data.model');
				$data = $this->_listingProvider->Create($model);
				return new ListingResponse($data);
			}
			throw new UserAuthorizationException('Unauthenticated request!');
		});
	}


	/**
	 * PUT : /api/listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function update(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id)
		{
			if(Gate::allows('user-admin'))
			{
				$model = $request->request->get('data.model');
				$data = $this->_listingProvider->Update($id, $model);
				return new ListingResponse($data);
			}

			throw new UserAuthorizationException('Unauthenticated request!');
		});
	}


	/**
	 * DELETE : /api/listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function delete(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id)
		{
			if(Gate::allows('user-admin'))
			{
				$this->_listingProvider->Delete($id);
				return null;
			}

			throw new UserAuthenticationException('Unauthenticated request!');
		});
	}
}
