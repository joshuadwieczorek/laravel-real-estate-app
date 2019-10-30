<?php

namespace App\Http\Responses;
use App\Core\ResponseBase;
use App\Models\ListingModel;
use Illuminate\Support\Collection;

class ListingsResponse extends ResponseBase
{
	/**
	 * Listings.
	 *
	 * @var Collection|null
	 */
	private $_listings;


	/**
	 * ListingsResponse constructor.
	 *
	 * @param Collection|null $listings
	 */
	public function __construct(?Collection $listings)
	{
		$this->_listings = $listings;
	}


	/**
	 * Prepare data.
	 *
	 * @return mixed
	 */
	public function Prepare()
	{
		$this->_data = [];

		if($this->_listings != null)
		{
			foreach($this->_listings as $listing)
			{
				$this->_data[] = (new ListingModel())->FromEntity($listing);
			}
		}
		else
			$this->_statusCode = 202;

	}
}