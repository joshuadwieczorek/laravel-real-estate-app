<?php

namespace App\ServiceProviders;
use App\Contracts\ServiceProviders\ListingsServiceProviderContract;
use App\Eloquent\Listing;
use App\Eloquent\ListingImage;
use App\Exceptions\ValidationException;
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
	 * @throws ValidationException
	 */
	public function ImageGet(int $listingId): ?Collection
	{
		$listing = $this->_listingsRepository->GetSingle($listingId);

		if($listing != null)
		{
			return collect($listing->images->all());
		}

		throw new ValidationException("Listing not found by id '$listingId'!");
	}


	/**
	 * Get a single image for a listing.
	 *
	 * @param int $listingId
	 * @param int $id
	 *
	 * @return Collection|null
	 * @throws ValidationException
	 */
	public function ImageGetSingle(int $listingId, int $id): ?ListingImage
	{
		$listing = $this->_listingsRepository->GetSingle($listingId);

		if($listing != null)
		{
			return $listing->images()->find($id);
		}

		throw new ValidationException("Listing not found by id '$listingId'!");
	}


	/**
	 * Create image and attach to listing.
	 *
	 * @param int $listingId
	 * @param ListingImageModel $image
	 *
	 * @return ListingImage
	 * @throws ValidationException
	 */
	public function ImageCreate(int $listingId, ListingImageModel $image): ListingImage
	{
		$listing = $this->_listingsRepository->GetSingle($listingId);

		if($listing != null)
		{
			// Create paths and names.
			$storagePath = env('UPLOAD_FILES_PATH') . DIRECTORY_SEPARATOR . $listingId;
			$filePathRoot = public_path($storagePath);
			$fileName = str_replace(' ', '-', $image->GetFile()->getClientOriginalName());
			$fullFilePath = $storagePath . DIRECTORY_SEPARATOR . $fileName;

			// Make directory for files if not exists.
			if(!file_exists($filePathRoot))
			{
				mkdir($filePathRoot);
			}

			if(file_exists($fullFilePath))
				throw new ValidationException("Image already exists '$fileName'!");

			// Save the file to disk.
			$fileContents = file_get_contents($image->GetFile()->getRealPath());
			file_put_contents($fullFilePath, $fileContents);

			$listingImage = $listing->images()->create([
				'listing_id' => $listingId,
				'title' => $image->title,
				'alt' => $image->alt,
				'url' => url($fullFilePath),
				'path' => public_path($fullFilePath)
			]);

			return $listingImage;
		}

		throw new ValidationException("Listing not found by id '$listingId'!");
	}


	/**
	 * Update image.
	 *
	 * @param int $listingId
	 * @param ListingImageModel $image
	 *
	 * @return ListingImage
	 * @throws ValidationException
	 */
	public function ImageUpdate(int $listingId, ListingImageModel $image): ListingImage
	{
		$listingImage = $this->ImageGetSingle($listingId, $image->id);

		if($listingImage != null)
		{
			if($image->title != null)
				$listingImage->title = $image->title;

			if($image->alt != null)
				$listingImage->alt = $image->alt;

			if($image->caption != null)
				$listingImage->caption = $image->caption;

			$listingImage->save();
			$listingImage->refresh();

			return $listingImage;
		}

		throw new ValidationException('Image not found!');
	}


	/**
	 * Delete image.
	 *
	 * @param int $listingId
	 * @param int $id
	 *
	 * @throws ValidationException
	 */
	public function ImageDelete(int $listingId, int $id): void
	{
		$listingImage = $this->ImageGetSingle($listingId, $id);

		if($listingImage != null)
		{
			unlink($listingImage->path);
			$listingImage->delete();
			return;
		}

		throw new ValidationException('Image not found!');
	}
}