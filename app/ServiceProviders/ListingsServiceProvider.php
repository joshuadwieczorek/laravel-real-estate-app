<?php

namespace App\ServiceProviders;
use App\Contracts\ServiceProviders\ListingsServiceProviderContract;
use App\Eloquent\Listing;
use App\Eloquent\ListingImage;
use App\Models\ListingImageModel;
use App\Models\ListingModel;
use Illuminate\Support\Collection;
use App\Contracts\Repositories\ListingsRepositoryContract;

class ListingsServiceProvider implements ListingsServiceProviderContract
{
	/**
	 * Listings repository.
	 *
	 * @var ListingsRepositoryContract
	 */
	private $_listingsRepository;


	/**
	 * ListingsServiceProvider constructor.
	 *
	 * @param ListingsRepositoryContract $listingsRepository
	 */
	public function __construct(ListingsRepositoryContract $listingsRepository)
	{
		$this->_listingsRepository = $listingsRepository;
	}


	/**
	 * Get active listings.
	 *
	 * @return Collection|null
	 */
	public function Get(): ?Collection
	{
		return $this->_listingsRepository->Get();
	}


	/**
	 * Get all listings.
	 *
	 * @return Collection|null
	 */
	public function GetAll(): ?Collection
	{
		return $this->_listingsRepository->GetAll();
	}


	/**
	 * Create single listing.
	 *
	 * @param int $id
	 *
	 * @return Listing
	 */
	public function GetSingle(int $id): ?Listing
	{
		return $this->_listingsRepository->GetSingle($id);
	}


	/**
	 * Create listing.
	 *
	 * @param ListingModel $listing
	 *
	 * @return Listing
	 */
	public function Create(ListingModel $listing): Listing
	{
		return $this->_listingsRepository->Create($listing);
	}


	/**
	 * Update listing.
	 *
	 * @param int $id
	 * @param ListingModel $listing
	 *
	 * @return Listing
	 */
	public function Update(int $id, ListingModel $listing): Listing
	{
		return $this->_listingsRepository->Update($id, $listing);
	}


	/**
	 * Soft-delete listing.
	 *
	 * @param int $id
	 *
	 * @return void
	 */
	public function Delete(int $id): void
	{
		$this->_listingsRepository->Delete($id);
	}


	/**
	 * Get all images for a listing.
	 *
	 * @param int $listingId
	 *
	 * @return Collection|null
	 */
	public function ImageGet(int $listingId): ?Collection
	{
		// TODO: Implement ImageGet() method.
	}


	/**
	 * Get a single image for a listing.
	 *
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return Collection|null
	 */
	public function ImageGetSingle(int $listingId, int $id): ?ListingImage
	{
		// TODO: Implement ImageGetSingle() method.
	}


	/**
	 * Create image and attach to listing.
	 *
	 * @param int $listingId
	 * @param ListingImageModel $image
	 *
	 * @return ListingImage|null
	 */
	public function ImageCreate(int $listingId, ListingImageModel $image): ListingImage
	{
		// TODO: Implement ImageCreate() method.
	}


	/**
	 * Update image.
	 *
	 * @param int $listingId
	 * @param ListingImageModel $image
	 *
	 * @return ListingImage
	 */
	public function ImageUpdate(int $listingId, ListingImageModel $image): ListingImage
	{
		// TODO: Implement ImageUpdate() method.
	}


	/**
	 * Delete image.
	 *
	 * @param int $listingId
	 * @param int $id
	 */
	public function ImageDelete(int $listingId, int $id): void
	{
		// TODO: Implement ImageDelete() method.
	}
}