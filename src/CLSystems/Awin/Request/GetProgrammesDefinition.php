<?php

namespace CLSystems\Awin\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetProgrammesDefinition
 *
 * @package CLSystems\Awin\Request
 */
class GetProgrammesDefinition extends AbstractRequestDefinition
{
	public function getMethod() : string
	{
		return 'GET';
	}

	public function getBaseUrl() : string
	{
		return sprintf('/publishers/%s/programmes?1', $this->getOptions()['publisherId']);
	}

	protected function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefined([
			'publisherId',
			'relationship',
			'countryCode',
		]);
		$resolver->setAllowedValues('relationship', ['joined', 'pending', 'suspended', 'rejected', 'notjoined']);
		$resolver->setRequired('publisherId');
	}
}
