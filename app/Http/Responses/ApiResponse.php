<?php

namespace App\Http\Responses;

class ApiResponse
{
	/**
	 * Api response wrapper.
	 *
	 * @var ?array
	 */
	private $_data;


	/**
	 * ApiResponse constructor.
	 *
	 * @param array $data
	 */
	public function __construct(?array $data)
	{
		$this->_data = $data;
	}


	/**
	 * Generate API response body.
	 *
	 * @param string $message
	 * @param int $statusCode
	 *
	 * @return array
	 */
	public function ToArray(string $message = '', int $statusCode = 200) : array
	{
		return [
			'status' => $statusCode,
			'message' => $message,
			'data' => $this->_data ?? []
		];
	}
}