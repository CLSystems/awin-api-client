<?php

namespace CLSystems\Awin\Enum;

/**
 * Class RelationshipTypeEnum
 *
 * @package CLSystems\Awin\Enum
 */
class RelationshipTypeEnum
{
	/**
	 * @const string
	 */
	public const JOINED    = 'joined';
	public const PENDING   = 'pending';
	public const SUSPENDED = 'suspended';
	public const REJECTED  = 'rejected';
	public const NOTJOINED = 'notjoined';
}
