<?php

namespace App\Core;

abstract class ResponseBase
{
	/**
	 * Response data.
	 *
	 * @var array
	 */
	protected $_data;


	/**
	 * Response message.
	 *
	 * @var string
	 */
	protected $_message = '';


	/**
	 * Response status code.
	 *
	 * @var int
	 */
	protected $_statusCode = 200;


	/**
	 * View path.
	 *
	 * @var string
	 */
	protected $_view;


	/**
	 * Return data associated with the response.
	 *
	 * @return mixed
	 */
	public function Data() : ?array
	{
		return $this->_data;
	}


	/**
	 * Return response message.
	 *
	 * @return string
	 */
	public function Message() : string
	{
		return $this->_message;
	}


	/**
	 * Prepare data.
	 *
	 * @return mixed
	 */
	public abstract function Prepare();


	/**
	 * Return response status code.
	 *
	 * @return int
	 */
	public function StatusCode() : int
	{
		return $this->_statusCode;
	}


	/**
	 * Return view path.
	 *
	 * @return string
	 */
	public function View() : ?string
	{
		return $this->_view;
	}
}