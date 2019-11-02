<?php

namespace App\Models;
use Illuminate\Http\Request;
use App\Contracts\DataModelContract;
use App\Contracts\DataModelFromEntityContract;
use Illuminate\Http\UploadedFile;

class ListingImageModel implements DataModelContract, DataModelFromEntityContract
{
	public $id;
	public $listingId;
	public $url;
	public $title;
	public $alt;
	public $caption;
	private $_file;


	/**
	 * Convert request to data model.
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function FromRequest(Request $request)
	{
		$this->title = $request->input('title');
		$this->alt = $request->input('alt');
		$this->caption = $request->input('caption');
		$this->_file = $request->file('image');
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
		$this->alt = $entity->alt ?? '';
		$this->caption = $entity->caption ?? '';
		return $this;
	}


	/**
	 * Get uploaded file.
	 *
	 * @return UploadedFile
	 */
	public function GetFile() : UploadedFile
	{
		return $this->_file;
	}
}