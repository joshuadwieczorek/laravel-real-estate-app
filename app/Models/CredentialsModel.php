<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Contracts\DataModelContract;

class CredentialsModel implements DataModelContract
{
	public $email;
	public $password;

	/**
	 * Convert request to model.
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function FromRequest(Request $request) : CredentialsModel
	{
		$this->email = $request->input('email');
		$this->password = $request->input('password');
		return $this;
	}
}