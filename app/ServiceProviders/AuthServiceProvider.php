<?php

namespace App\ServiceProviders;
use App\Contracts\Repositories\UserLogsRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Enums\UserStatusEnum;
use App\Exceptions\UserAuthenticationException;
use App\Models\UserLogModel;
use Exception;
use App\Contracts\ServiceProviders\AuthServiceProviderContract;
use App\Models\CredentialsModel;
use App\Models\UserRegisterModel;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider implements AuthServiceProviderContract
{
	/**
	 * User repository.
	 *
	 * @var UserRepositoryContract
	 */
	private $_userRepository;


	/**
	 * User logs repository.
	 *
	 * @var UserLogsRepositoryContract
	 */
	private $_userLogsRepository;


	/**
	 * AuthServiceProvider constructor.
	 *
	 * @param UserRepositoryContract $userRepository
	 * @param UserLogsRepositoryContract $userLogsRepository
	 */
	public function __construct(UserRepositoryContract $userRepository, UserLogsRepositoryContract $userLogsRepository)
	{
		$this->_userRepository = $userRepository;
		$this->_userLogsRepository = $userLogsRepository;
	}


	/**
	 * Log the user in.
	 *
	 * @param CredentialsModel $credentials
	 *
	 * @throws UserAuthenticationException
	 */
	public function Login(CredentialsModel $credentials) : void
	{
		try
		{
			if(!$this->_LoginAttemptsExceeded())
			{
				$user = $this->_userRepository->FindByEmail($credentials->email);

				if($user != null)
				{
					$userAttemptCreds = [
						'email' => $credentials->email,
						'password' => $credentials->password,
						'status' => UserStatusEnum::Active
					];

					if(Auth::attempt($userAttemptCreds))
					{
						$this->_Log($user->id, $user->status, 'User logged in!');
						$this->_userRepository->UpdateLastLogin($user);
					}
					else
					{
						$this->_Log($user->id, $user->status, 'Invalid email/password combination or user is not active!');
						throw new Exception('Invalid email/password combination or user is not active!');
					}
				}
				else
				{
					$this->_Log(null, UserStatusEnum::None, 'User not found by email!');
					throw new Exception('User not found by email!');
				}
			}
			else
				session(['login_attempts_exceeded' => true]);


		}
		catch (Exception $exception)
		{
			$this->_AddLoginAttempt();
			throw new UserAuthenticationException('Invalid login credentials!', 1, $exception);
		}
	}


	/**
	 * Logout the user.
	 */
	public function Logout() : void
	{
		Auth::logout();
	}


	/**
	 * Register a new user.
	 *
	 * @param UserRegisterModel $userRegisterModel
	 */
	public function Register(UserRegisterModel $userRegisterModel)
	{
		// TODO: Implement register() method.
	}


	/**
	 * Increase login attempts.
	 */
	private function _AddLoginAttempt() : void
	{
		$loginAttempts = session('login_attempts', 0);

		if($loginAttempts === 0)
			$loginAttempts +=1;

		session(['login_attempts' => $loginAttempts]);
	}


	/**
	 * Check if login attempts exceeded.
	 *
	 * @return bool
	 */
	private function _LoginAttemptsExceeded() : bool
	{
		$maxLoginAttempts = env('MAX_LOGIN_ATTEMPTS');
		$loginAttempts = $value = session('login_attempts', 0);
		return $loginAttempts >= $maxLoginAttempts;
	}


	/**
	 * Log user log.
	 *
	 * @param int|null $userId
	 * @param int $status
	 * @param string $message
	 */
	private function _Log(?int $userId, int $status, string $message) : void
	{
		$logModel = new UserLogModel();
		$logModel->userId = $userId;
		$logModel->userStatus = $status;
		$logModel->message = $message;
		$this->_userLogsRepository->Log($logModel);
	}
}