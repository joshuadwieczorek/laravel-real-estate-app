<?php

namespace App\Http\Controllers\Api;
use App\Exceptions\UserAuthorizationException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ListingImageResponse;
use App\Http\Responses\ListingImagesResponse;
use Illuminate\Http\Request;
use App\Contracts\ServiceProviders\ListingsServiceProviderContract;
use Illuminate\Support\Facades\Gate;

class ListingsImagesController extends Controller
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
	 * GET : /api/listings/{listingId}/images
	 *
	 * @param Request $request
	 * @param int $listingId
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function get(Request $request, int $listingId)
	{
		return $this->Response(function() use($request, $listingId) {
			$data = $this->_listingProvider->ImageGet($listingId);
			return new ListingImagesResponse($data);
		});
	}


	/**
	 * View : /api/listings/{id}
	 * GET : /api/listings/{id}
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function getSingle(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id) {
			$data = $this->_listingProvider->ImageGetSingle($listingId, $id);
			return new ListingImageResponse($data);
		});
	}


	/**
	 * POST : /api/listings
	 *
	 * @param int $listingId
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function create(Request $request, int $listingId)
	{
		return $this->Response(function() use($listingId, $request)
		{
			if(Gate::allows('user-admin'))
			{
				$model = $request->request->get('data.model');
				$data = $this->_listingProvider->ImageCreate($listingId, $model);
				return new ListingImageResponse($data);
			}
			throw new UserAuthorizationException('Unauthorized request!');
		});
	}


	/**
	 * PUT : /api/listings/{listingId}/images/{id}
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function update(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id)
		{
			if(Gate::allows('user-admin'))
			{
				$model = $request->request->get('data.model');
				$model->id = $id;
				$model->listingId = $listingId;
				$data = $this->_listingProvider->ImageUpdate($listingId, $model);
				return new ListingImageResponse($data);
			}

			throw new UserAuthorizationException('Unauthorized request!');
		});
	}


	/**
	 * DELETE : /api/listings/{listingId}/images/{id}
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function delete(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id)
		{
			if(Gate::allows('user-admin'))
			{
				$this->_listingProvider->ImageDelete($listingId, $id);
				return null;
			}

			throw new UserAuthorizationException('Unauthorized request!');
		});
	}
}
