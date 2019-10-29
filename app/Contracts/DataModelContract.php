<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface DataModelContract
{
	/**
	 * Convert request to data model.
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function FromRequest(Request $request);
}