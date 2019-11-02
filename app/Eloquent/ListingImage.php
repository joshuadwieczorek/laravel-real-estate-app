<?php

namespace App\Eloquent;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $table = 'listings_images';


	/**
	 * Primary key.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';


	/**
	 * Mass fillable attributes.
	 *
	 * @var array
	 */
	protected $fillable = [
		'listing_id', 'url', 'path', 'title', 'alt', 'caption'
	];
}