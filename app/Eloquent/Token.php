<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
    protected $table = 'tokens';


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
    	'user_id', 'session_id', 'token', 'type', 'expires_at'
    ];


	/**
	 * Token's user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}