<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
    protected $table = 'roles';


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
    	'name'
    ];
}