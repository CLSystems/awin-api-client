<?php

namespace CLSystems\Awin\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetTransactionsDefinition
 *
 * @package CLSystems\Awin\Request
 */
class GetTransactionsDefinition extends AbstractRequestDefinition
{
	public function getMethod() : string
	{
		return 'GET';
	}

	public function getBaseUrl() : string
	{
		return sprintf('/publishers/%s/transactions/', $this->getOptions()['publisherId']);
	}

	protected function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefined([
			'publisherId',
			'startDate',
			'endDate',
			'dateType',
			'timezone',
			'status',
		]);
		$resolver->setAllowedValues('dateType', ['transaction', 'validation']);
		$resolver->setAllowedValues('timezone', ['Europe/Berlin', 'Europe/Paris', 'Europe/London', 'Europe/Dublin', 'Canada/Eastern', 'Canada/Central', 'Canada/Mountain', 'Canada/Pacific', 'US/Eastern', 'US/Central', 'US/Mountain', 'US/Pacific', 'UTC']);
		$resolver->setAllowedValues('status', ['pending', 'approved', 'declined', 'deleted']);
		$resolver->setRequired('publisherId');
	}
}
