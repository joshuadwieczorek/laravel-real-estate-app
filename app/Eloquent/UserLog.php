<?php

namespace App\Eloquent;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $table = 'users_logs';


	/**
	 * Primary key.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'user_status', 'message',
	];
}