<?php

namespace App\Http\Responses;
use App\Core\ResponseBase;
use App\Eloquent\ListingImage;
use App\Models\ListingImageModel;

class ListingImageResponse extends ResponseBase
{
	/**
	 * Listings.
	 *
	 * @var ListingImage|null
	 */
	private $_listingImage;


	/**
	 * ListingResponse constructor.
	 *
	 * @param ListingImage|null $listingImage
	 */
	public function __construct(?ListingImage $listingImage)
	{
		$this->_listingImage = $listingImage;
		$this->_view = 'listings.images.listings-single';
	}


	/**
	 * Prepare data.
	 */
	public function Prepare()
	{
		if($this->_listingImage != null)
		{
			$this->_data = (new ListingImageModel())->FromEntity($this->_listingImage);
		}
		else
			$this->_statusCode = 204;
	}
}