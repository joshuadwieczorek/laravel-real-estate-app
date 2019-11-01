<?php

namespace App\Exceptions;
use Exception;
use Throwable;

class UserAuthorizationException extends Exception implements Throwable {

	/**
	 * UserAuthenticationException constructor.
	 *
	 * @param String $message
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct(string $message = "", int $code = 0, Throwable $previous = null )
	{
		parent::__construct( $message, $code, $previous );
	}
}