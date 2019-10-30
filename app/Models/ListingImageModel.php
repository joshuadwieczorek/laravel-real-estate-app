<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Contracts\DataModelContract;
use App\Contracts\DataModelFromEntityContract;

class ListingImageModel implements DataModelContract, DataModelFromEntityContract
{
	public $id;
	public $listingId;
	public $url;
	public $title;
	public $alt;


	/**
	 * Convert request to data model.
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function FromRequest(Request $request)
	{
		$this->url = $request->input('url');
		$this->title = $request->input('title');
		$this->alt = $request->input('alt');
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
		$this->listingId = $entity->listing_id;
		$this->url = $entity->url;
		$this->title = $entity->title;
		$this->alt = $entity->alt;
		return $this;
	}
}