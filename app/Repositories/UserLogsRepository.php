<?php

namespace App\Repositories;
use App\Contracts\Repositories\UserLogsRepositoryContract;
use App\Models\UserLogModel;
use App\Eloquent\UserLog;

class UserLogsRepository implements UserLogsRepositoryContract
{

	/**
	 * Log user activity.
	 *
	 * @param UserLogModel $logModel
	 */
	public function Log(UserLogModel $logModel): void
	{
		UserLog::create([
			'user_id' => $logModel->userId,
			'user_status' => $logModel->userStatus,
			'message' => $logModel->message
		]);
	}
}