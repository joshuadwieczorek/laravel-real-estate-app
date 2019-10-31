<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Contracts\DataModelContract;
use App\Contracts\DataModelFromEntityContract;

class ListingModel implements DataModelContract, DataModelFromEntityContract
{
	public $id;
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
	public $images = [];

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
		$this->purchaseRent = $request->input('purchaseRent');
		$this->bedrooms = $request->input('bedrooms');
		$this->bathrooms = $request->input('bathrooms');
		$this->squareFeet = $request->input('squareFeet');
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


	/**
	 * Convert entity to model.
	 *
	 * @param $entity
	 *
	 * @return mixed
	 */
	public function FromEntity($entity)
	{
		$this->id = $entity->id;
		$this->title = $entity->title ?? '';
		$this->description = $entity->description ?? '';
		$this->price = $entity->price ?? '';
		$this->purchaseRent = $entity->purchase_rent ?? '';
		$this->bedrooms = $entity->bedrooms ?? '';
		$this->bathrooms = $entity->bathrooms ?? '';
		$this->squareFeet = $entity->square_feet ?? '';
		$this->address1 = $entity->address1 ?? '';
		$this->address2 = $entity->address2 ?? '';
		$this->city = $entity->city ?? '';
		$this->state = $entity->state ?? '';
		$this->zip = $entity->zip ?? '';
		$this->listingAgent = $entity->listing_agent ?? '';
		$this->details = $entity->details ?? '';
		$this->active = $entity->active;

		if($entity->images != null && $entity->images->count() > 0)
		{
			foreach($entity->images as $image)
			{
				$this->images[] = (new ListingImageModel())->FromEntity($image);
			}
		}

		return $this;
	}
}