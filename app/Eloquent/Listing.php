<?php

namespace App\Eloquent;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $table = 'listings';


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
		'title', 'description', 'price', 'purchase_rent', 'bedrooms', 'bathrooms', 'square_feet',
		'address1', 'address2', 'city', 'state', 'zip', 'listing_agent', 'details', 'active'
	];
}
