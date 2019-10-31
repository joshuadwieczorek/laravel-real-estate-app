<?php

namespace App\Http\Responses;
use App\Core\ResponseBase;
use App\Eloquent\Listing;
use App\Models\ListingModel;

class ListingResponse extends ResponseBase
{
	/**
	 * Listings.
	 *
	 * @var Listing|null
	 */
	private $_listing;


	/**
	 * ListingResponse constructor.
	 *
	 * @param Listing|null $listing
	 */
	public function __construct(?Listing $listing)
	{
		$this->_listing = $listing;
		$this->_view = 'listings.listings-single';
	}


	/**
	 * Prepare data.
	 */
	public function Prepare()
	{
		if($this->_listing != null)
		{
			$this->_data = (new ListingModel())->FromEntity($this->_listing);
		}
		else
			$this->_statusCode = 202;
	}
}