<?php

namespace App\Repositories;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Eloquent\User;
use App\Enums\UserStatusEnum;

class UserRepository implements UserRepositoryContract
{

	/**
	 * Find user by email.
	 *
	 * @param string $email
	 *
	 * @return User|null
	 */
	public function FindByEmail(string $email): ?User
	{
		return User::where('email', $email)
			->where('status', UserStatusEnum::Active)
			->first();
	}


	/**
	 * Update user's last login time.
	 *
	 * @param User $user
	 */
	public function UpdateLastLogin(User $user): void
	{
		$user->time_last_login = now();
		$user->save();
	}


	/**
	 * Change a user's status.
	 *
	 * @param User $user
	 * @param UserStatusEnum $status
	 */
	public function ChangeStatus( User $user, UserStatusEnum $status ): void
	{
		$user->status = $status;
		$user->save();
	}
}