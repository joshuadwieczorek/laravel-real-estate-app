<?php

namespace App\Repositories;
use App\Contracts\Repositories\ListingsRepositoryContract;
use App\Eloquent\Listing;
use App\Models\ListingModel;
use Illuminate\Support\Collection;

class ListingsRepository implements ListingsRepositoryContract
{
	/**
	 * Get all active listings.
	 *
	 * @return Collection|null
	 */
	public function Get(): ?Collection
	{
		return Listing::where('active', 1)->get();
	}


	/**
	 * Get all listings (active/non-active)
	 *
	 * @return Collection|null
	 */
	public function GetAll(): ?Collection
	{
		return Listing::all();
	}


	/**
	 * Get single listing.
	 *
	 * @param int $id
	 *
	 * @return Listing
	 */
	public function GetSingle(int $id): ?Listing
	{
		return Listing::where('id', $id)
		              ->where('active', 1)
		              ->first();
	}


	/**
	 * Create new listing.
	 *
	 * @param ListingModel $model
	 *
	 * @return Listing
	 */
	public function Create(ListingModel $model): Listing
	{
		return Listing::create([
			'title' => $model->title,
			'description' => $model->description,
			'price' => $model->price,
			'purchase_rent' => $model->purchaseRent,
			'bedrooms' => $model->bedrooms,
			'bathrooms' => $model->bathrooms,
			'square_feet' => $model->squareFeet,
			'address1' => $model->address1,
			'address2' => $model->address2,
			'city' => $model->city,
			'state' => $model->state,
			'zip' => $model->zip,
			'listing_agent' => $model->listingAgent,
			'details' => $model->details,
			'active' => 1
		]);
	}


	/**
	 * Update listing.
	 *
	 * @param ListingModel $model
	 *
	 * @return Listing
	 */
	public function Update(ListingModel $model): Listing
	{
		// TODO: Implement Update() method.
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
		// TODO: Implement Delete() method.
	}
}