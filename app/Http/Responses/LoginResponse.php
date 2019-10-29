<?php

namespace App\Http\Responses;
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
		$this->_message = 'Successful login!';
	}

	/**
	 * Prepare data.
	 *
	 * @return mixed
	 */
	public function Prepare() { }
}