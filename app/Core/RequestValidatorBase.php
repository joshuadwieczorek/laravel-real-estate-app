<?php

namespace App\Core;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

abstract class RequestValidatorBase
{
	/**
	 * Whether or not the request is valid.
	 *
	 * @var bool
	 */
	public $isValid;


	/**
	 * Request validator.
	 *
	 * @var Validator
	 */
	public $validator;


	/**
	 * Array of validation rules.
	 *
	 * @return array
	 */
	protected abstract function Rules() : array;


	/**
	 * Array of validation messages.
	 *
	 * @return array
	 */
	protected abstract function Messages() : array;


	/**
	 * Validate the request.
	 *
	 * @param Request $request
	 */
	public function Validate(Request $request)
	{
		$this->validator = Validator::make($request->all(), $this->Rules(), $this->Messages());
		$this->isValid = !$this->validator->fails();
	}
}