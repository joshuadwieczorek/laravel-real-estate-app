<?php

namespace App\Contracts\Repositories;
use App\Eloquent\User;
use App\Enums\UserStatusEnum;

interface UserRepositoryContract
{
	/**
	 * Find user by email.
	 *
	 * @param string $email
	 *
	 * @return User|null
	 */
	public function FindByEmail(string $email) : ?User;


	/**
	 * Update user's last login time.
	 *
	 * @param User $user
	 */
	public function UpdateLastLogin(User $user) : void;


	/**
	 * Change a user's status.
	 *
	 * @param User $user
	 * @param UserStatusEnum $status
	 */
	public function ChangeStatus(User $user, UserStatusEnum $status) : void;
}