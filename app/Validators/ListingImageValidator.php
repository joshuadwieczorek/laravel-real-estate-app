<?php

namespace App\Validators;
use App\Core\RequestValidatorBase;
use Illuminate\Validation\Rule;

class ListingImageValidator extends RequestValidatorBase {

	/**
	 * Array of validation rules.
	 *
	 * @return array
	 */
	protected function Rules(): array
	{
		return [
			'title' => 'required|min:2|max:50',
			'image' => 'required|image',
			'alt' => 'string',
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
			'title.required' => 'Listing title is required!',
			'image.required' => 'Image file is required!',
			'image.image' => 'Image is invalid file type!',
		];
	}
}