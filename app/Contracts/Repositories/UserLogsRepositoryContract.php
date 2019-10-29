<?php

namespace App\Contracts\Repositories;

use App\Models\UserLogModel;

interface UserLogsRepositoryContract
{
	/**
	 * Log user activity.
	 *
	 * @param UserLogModel $logModel
	 */
	public function Log(UserLogModel $logModel) : void;
}