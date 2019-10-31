<?php

namespace App\Contracts\Repositories;
use App\Eloquent\Listing;
use App\Models\ListingModel;
use Illuminate\Support\Collection;

interface ListingsRepositoryContract
{
	/**
	 * Get all active listings.
	 *
	 * @return Collection|null
	 */
	public function Get() : ?Collection;

	/**
	 * Get all listings (active/non-active)
	 *
	 * @return Collection|null
	 */
	public function GetAll() : ?Collection;

	/**
	 * Get single listing.
	 *
	 * @param int $id
	 *
	 * @return Listing
	 */
	public function GetSingle(int $id) : ?Listing;

	/**
	 * Create new listing.
	 *
	 * @param ListingModel $model
	 *
	 * @return Listing
	 */
	public function Create(ListingModel $model) : Listing;

	/**
	 * Update listing.
	 *
	 * @param ListingModel $model
	 *
	 * @return Listing
	 */
	public function Update(ListingModel $model) : Listing;

	/**
	 * Soft-delete listing.
	 *
	 * @param int $id
	 *
	 * @return void
	 */
	public function Delete(int $id) : void;
}