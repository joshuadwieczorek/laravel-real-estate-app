<?php

namespace App\Contracts\ServiceProviders;
use App\Eloquent\ListingImage;
use Illuminate\Support\Collection;
use App\Eloquent\Listing;
use App\Models\ListingModel;
use App\Models\ListingImageModel;

interface ListingsServiceProviderContract
{
	/**
	 * Get active listings.
	 *
	 * @return Collection|null
	 */
	public function Get() : ?Collection;


	/**
	 * Get all listings.
	 *
	 * @return Collection|null
	 */
	public function GetAll() : ?Collection;


	/**
	 * Create single listing.
	 *
	 * @param int $id
	 *
	 * @return Listing
	 */
	public function GetSingle(int $id) : Listing;


	/**
	 * Create listing.
	 *
	 * @param ListingModel $listing
	 *
	 * @return Listing
	 */
	public function Create(ListingModel $listing) : Listing;


	/**
	 * Update listing.
	 *
	 * @param int $id
	 * @param ListingModel $listing
	 *
	 * @return Listing
	 */
	public function Update(int $id, ListingModel $listing) : Listing;


	/**
	 * Soft-delete listing.
	 *
	 * @param int $id
	 *
	 * @return void
	 */
	public function Delete(int $id) : void;


	/**
	 * Get all images for a listing.
	 *
	 * @param int $listingId
	 *
	 * @return Collection|null
	 */
	public function ImageGet(int $listingId) : ?Collection;


	/**
	 * Get a single image for a listing.
	 *
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return Collection|null
	 */
	public function ImageGetSingle(int $listingId, int $id) : ?ListingImage;


	/**
	 * Create image and attach to listing.
	 *
	 * @param int $listingId
	 * @param ListingImageModel $image
	 *
	 * @return ListingImage|null
	 */
	public function ImageCreate(int $listingId, ListingImageModel $image) : ListingImage;


	/**
	 * Update image.
	 *
	 * @param int $listingId
	 * @param ListingImageModel $image
	 *
	 * @return ListingImage
	 */
	public function ImageUpdate(int $listingId, ListingImageModel $image) : ListingImage;


	/**
	 * Delete image.
	 *
	 * @param int $listingId
	 * @param int $id
	 */
	public function ImageDelete(int $listingId, int $id) : void;
}