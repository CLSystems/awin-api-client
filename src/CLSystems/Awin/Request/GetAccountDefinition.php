<?php

namespace CLSystems\Awin\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetAccountDefinition
 *
 * @package CLSystems\Awin\Request
 */
class GetAccountDefinition extends AbstractRequestDefinition
{
	/**
	 * @return string
	 */
	public function getMethod() : string
	{
		return 'GET';
	}

	/**
	 * @return string
	 */
	public function getBaseUrl() : string
	{
		return sprintf('/accounts?1');
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	protected function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefined([
			'type',
		]);
		$resolver->setAllowedValues('type', ['publisher', 'advertiser']);
	}
}
