<?php

namespace App\Http\Responses;
use App\Core\ResponseBase;
use App\Models\ListingImageModel;
use Illuminate\Support\Collection;

class ListingImagesResponse extends ResponseBase
{
	/**
	 * Listings.
	 *
	 * @var Collection|null
	 */
	private $_listingImages;


	/**
	 * ListingResponse constructor.
	 *
	 * @param Collection|null $listingImages
	 */
	public function __construct(?Collection $listingImages)
	{
		$this->_listingImages = $listingImages;
		$this->_view = 'listings.images.listings-get';
	}


	/**
	 * Prepare data.
	 */
	public function Prepare()
	{
		if($this->_listingImages != null)
		{
			$this->_data = [];

			foreach($this->_listingImages as $listingImage)
			{
				$this->_data[] = (new ListingImageModel())->FromEntity($listingImage);
			}
		}
		else
			$this->_statusCode = 204;
	}
}