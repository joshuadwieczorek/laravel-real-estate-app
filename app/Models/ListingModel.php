<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Contracts\DataModelContract;

class ListingModel implements DataModelContract
{
	public $title;
	public $description;
	public $price;
	public $purchaseRent;
	public $bedrooms;
	public $bathrooms;
	public $squareFeet;
	public $address1;
	public $address2;
	public $city;
	public $state;
	public $zip;
	public $listingAgent;
	public $details;
	public $active;

	/**
	 * Convert request to data model.
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function FromRequest(Request $request)
	{
		$this->title = $request->input('title');
		$this->description = $request->input('description');
		$this->price = $request->input('price');
		$this->purchaseRent = $request->input('purchase_rent');
		$this->bedrooms = $request->input('bedrooms');
		$this->bathrooms = $request->input('bathrooms');
		$this->squareFeet = $request->input('square_feet');
		$this->address1 = $request->input('address1');
		$this->address2 = $request->input('address2');
		$this->city = $request->input('city');
		$this->state = $request->input('state');
		$this->zip = $request->input('zip');
		$this->listingAgent = $request->input('listingAgent');
		$this->details = $request->input('details');
		$this->active = $request->input('active');
		return $this;
	}
}