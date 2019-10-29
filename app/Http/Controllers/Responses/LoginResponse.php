<?php

namespace App\Http\Controllers\Responses;
use App\Core\ResponseBase;

class LoginResponse extends ResponseBase
{
	/**
	 * LoginResponse constructor.
	 */
	public function __construct()
	{
		$this->_view = 'auth.login';
		$this->_data = [];
	}

	/**
	 * Prepare data.
	 *
	 * @return mixed
	 */
	public function Prepare() { }
}