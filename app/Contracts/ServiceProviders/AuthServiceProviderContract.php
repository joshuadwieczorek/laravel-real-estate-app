<?php

namespace App\Contracts\ServiceProviders;
use App\Exceptions\UserAuthenticationException;
use App\Models\CredentialsModel;
use App\Models\UserRegisterModel;

interface AuthServiceProviderContract
{
	/**
	 * Log user into the system.
	 *
	 * @param CredentialsModel $credentials
	 *
	 * @throws UserAuthenticationException
	 */
	public function Login(CredentialsModel $credentials) : void;


	/**
	 * Log the user out.
	 */
	public function Logout() : void;


	/**
	 * Register new user.
	 *
	 * @param UserRegisterModel $userRegisterModel
	 *
	 * @return mixed
	 */
	public function Register(UserRegisterModel $userRegisterModel);
}