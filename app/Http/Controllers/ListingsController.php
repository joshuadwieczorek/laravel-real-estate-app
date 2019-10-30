<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
	/**
	 * ListingsController constructor.
	 */
	public function __construct()
	{

	}


	/**
	 * View : /listings
	 * GET : /listings
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function index(Request $request)
	{
		return $this->Response(function() use($request) {

		});
	}


	/**
	 * View : /listings/{id}
	 * GET : /listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function show(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id) {

		});
	}


	/**
	 * View : none
	 * POST : /listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function create(Request $request)
	{
		return $this->Response(function() use($request) {

		});
	}


	/**
	 * View : /listings/{id}
	 * GET : none
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function edit(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id) {

		});
	}


	/**
	 * View : none
	 * PUT : /listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function update(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id) {

		});
	}


	/**
	 * View : none
	 * DELETE : /listings/{id}
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function delete(Request $request, int $id)
	{
		return $this->Response(function() use($request, $id) {

		});
	}
}