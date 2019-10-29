<?php

namespace App\Eloquent;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'time_last_login' => 'datetime',
    ];


	/**
	 * User's roles.
	 */
    public function roles()
    {
    	return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id')
		    ->withTimestamps();
    }


	/**
	 * Check if user has role.
	 *
	 * @param string $roleName
	 *
	 * @return bool
	 */
    public function hasRole(string $roleName) : bool
    {
        foreach($this->roles as $role)
        {
        	if($role->name == $roleName)
        		return true;
        }

        return false;
    }
}