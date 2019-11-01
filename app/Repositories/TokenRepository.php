<?php

namespace App\Repositories;
use App\Eloquent\Token;
use App\Enums\TokenTypeEnum;
use App\Exceptions\UserAuthenticationException;
use Illuminate\Support\Str;

class TokenRepository
{
	private $_userId;
	private $_sessionId;
	private $_token;
	private $_expireMinutes;


	/**
	 * TokenRepository constructor.
	 *
	 * @param int $expireMinutes
	 */
	public function __construct($expireMinutes = 15)
	{
		$this->_expireMinutes = $expireMinutes;
		$this->_sessionId = session()->getId();
		$this->_userId = null;

		if(auth()->check())
			$this->_userId = auth()->id();
	}


	/**
	 * Create a new token.
	 */
	public function Create()
	{
		$this->_token = Token::create([
			'user_id' => $this->_userId,
			'session_id' => $this->_sessionId,
			'token' => Str::random(32),
			'type' => TokenTypeEnum::Api,
			'expires_at' => now()->addMinutes($this->_expireMinutes)
		]);
	}


	/**
	 * Extend token.
	 */
	public function Extend()
	{
		if($this->_token != null)
		{
			$this->_token->expires_at = now()->addMinutes($this->_expireMinutes);
			$this->updated_at = now();
			$this->_token->save();
		}
	}


	/**
	 * Expire token.
	 */
	public function Expire()
	{
		if($this->_token != null)
		{
			$this->_token->expired = 1;
			$this->_token->save();
		}
	}


	/**
	 * Check if token exists.
	 *
	 * @return bool
	 */
	public function Exists()
	{
		$this->_token = Token::where('user_id', $this->_userId)
		                     ->where('session_id', $this->_sessionId)
		                     ->where('expired', 0)
		                     ->first();

		if($this->_token != null)
			$this->Extend();

		return $this->_token != null;
	}


	/**
	 * Check if token is expired.
	 *
	 * @return bool
	 */
	public function IsExpired()
	{
		$expired = true;

		if($this->_token != null)
			$expired = now() >= $this->_token->expires_at;

		if($expired)
			$this->Expire();

		return $expired;
	}


	/**
	 * Find current non-expired token.
	 *
	 * @param string $token
	 *
	 * @return bool
	 */
	public function FindAndLogin(string $token) : bool
	{
		$this->_token = Token::where('token', $token)
		                     ->where('expired', 0)
		                     ->first();

		if($this->_token != null)
		{
			$this->Extend();

			if($this->_token->user != null)
			{
				if(auth()->onceUsingId($this->_token->user->id))
					return true;
			}
			else
				return true;
		}

		return false;
	}
}