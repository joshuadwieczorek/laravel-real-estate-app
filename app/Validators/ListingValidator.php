<?php

namespace App\Validators;
use App\Core\RequestValidatorBase;
use Illuminate\Validation\Rule;

class ListingValidator extends RequestValidatorBase {

	/**
	 * Array of validation rules.
	 *
	 * @return array
	 */
	protected function Rules(): array
	{
		return [
			'title' => 'required|min:2|max:25',
			'price' => 'required|regex:/^\d*(\.\d{2})?$/',
			'purchaseRent' => Rule::in(['purchase', 'rent']),
			'bedrooms' => 'required|numeric',
			'bathrooms' => 'required|numeric',
			'squareFeet' => 'required|numeric',
			'zip' => 'numeric',
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
			'title' => 'Listing title is required!',
			'price' => 'Listing price is required!',
		];
	}
}