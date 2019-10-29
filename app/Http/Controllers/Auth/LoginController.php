<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Contracts\ServiceProviders\AuthServiceProviderContract;
use App\Http\Responses\LoginResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	/**
	 * Auth service provider.
	 *
	 * @var AuthServiceProviderContract
	 */
	private $_authService;


	/**
	 * LoginController constructor.
	 *
	 * @param AuthServiceProviderContract $authService
	 */
	public function __construct(AuthServiceProviderContract $authService)
	{
		$this->_authService = $authService;
	}


	/**
	 * POST : /auth/login
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
	 */
	public function Login(Request $request)
	{
		return $this->Response(function() use($request) {
			$this->_authService->Login($request->request->get('data.model'));
			return new LoginResponse();
		});
	}
}