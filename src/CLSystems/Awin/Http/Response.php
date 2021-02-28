<?php

namespace CLSystems\Awin\Http;

/**
 * Class Response
 *
 * @package CLSystems\Awin\Http
 */
class Response
{
	/**
	 * @var string
	 */
	protected $statusCode;

	/**
	 * @var string
	 */
	protected $body;

	/**
	 * @param string $statusCode statusCode
	 * @param string $body body
	 */
	public function __construct(string $statusCode, string $body)
	{
		$this->statusCode = $statusCode;
		$this->body = $body;
	}

	/**
	 * @return string
	 */
	public function getStatusCode() : string
	{
		return $this->statusCode;
	}

	/**
	 * @return array
	 */
	public function getBody() : array
	{
		return json_decode($this->body, true);
	}
}
