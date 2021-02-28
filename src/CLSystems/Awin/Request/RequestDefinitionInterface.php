<?php

namespace CLSystems\Awin\Request;

/**
 * Interface RequestDefinitionInterface
 *
 * @package CLSystems\Awin\Request
 */
interface RequestDefinitionInterface
{
	/**
	 * @return string
	 */
	public function getMethod() : string;

	/**
	 * @return string
	 */
	public function getUrl() : string;

	/**
	 * @return string
	 */
	public function getBody() : string;
}
