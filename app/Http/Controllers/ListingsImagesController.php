<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contracts\ServiceProviders\ListingsServiceProviderContract;

class ListingsImagesController extends Controller
{
	/**
	 * Listings service provider.
	 *
	 * @var ListingsServiceProviderContract
	 */
	private $_listingProvider;


	/**
	 * ListingsImagesController constructor.
	 *
	 * @param ListingsServiceProviderContract $listingProvider
	 */
	public function __construct(ListingsServiceProviderContract $listingProvider)
	{
		$this->_listingProvider = $listingProvider;
	}


	/**
	 * View : /listings/{listingId}/images
	 * GET : /listings/{listingId}/images
	 *
	 * @param Request $request
	 * @param int $listingId
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function index(Request $request, int $listingId)
	{
		return $this->Response(function() use($request, $listingId) {

		});
	}


	/**
	 * View : /listings/{listingId}/images
	 * GET : /listings/{listingId}/images
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function show(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id) {

		});
	}


	/**
	 * View : none
	 * POST : /listings/{id}/images
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function create(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id) {

		});
	}


	/**
	 * View : /listings/{listingId}/images/{id}
	 * GET : none
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function edit(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id) {

		});
	}


	/**
	 * View : none
	 * PUT : /listings/{listingId}/images/{id}
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function update(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id) {

		});
	}


	/**
	 * View : none
	 * DELETE : /listings/{listingId}/images/{id}
	 *
	 * @param Request $request
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function delete(Request $request, int $listingId, int $id)
	{
		return $this->Response(function() use($request, $listingId, $id) {

		});
	}
}