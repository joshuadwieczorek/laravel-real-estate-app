<?php

namespace App\Validators;
use App\Core\RequestValidatorBase;

class CredentialsValidator extends RequestValidatorBase {

	/**
	 * Array of validation rules.
	 *
	 * @return array
	 */
	protected function Rules(): array
	{
		return [
			'email' => 'required',
			'password' => 'required',
		];
	}


	/**
	 * Array of validation messages.
	 *
	 * @return array
	 */
	protected function Messages(): array
	{
		return [
			'email' => 'Your email is required!',
			'password' => 'Your password is required!',
		];
	}
}