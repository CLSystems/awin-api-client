<?php

namespace CLSystems\Awin\Request;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractRequestDefinition
 *
 * @package CLSystems\Awin\Request
 */
abstract class AbstractRequestDefinition implements RequestDefinitionInterface
{
	/**
	 * @var array
	 */
	private $optional = [];

	/**
	 * @var array
	 */
	private $required = [];

	/**
	 * @param array $options
	 */
	public function __construct(array $options = [])
	{
		$resolver = new OptionsResolver();
		$this->configureOptions($resolver);

		$options = $resolver->resolve($options);
		foreach ($options as $optionName => $optionValue)
		{
			if ($resolver->isRequired($optionName))
			{
				$this->required[$optionName] = $optionValue;
			}
			else
			{
				$this->optional[$optionName] = $optionValue;
			}
		}
	}

	/**
	 * @return string
	 */
	abstract public function getMethod() : string;

	/**
	 * @return string
	 */
	abstract public function getBaseUrl() : string;

	/**
	 * @return string
	 */
	public function getUrl() : string
	{
		$url = $this->getBaseUrl();
		if ('GET' === $this->getMethod() && !empty($this->optional))
		{
			$options = $this->transformOptions();
			$url = sprintf('%s?%s', $url, http_build_query($options));
		}
		return $url;
	}

	/**
	 * @return array
	 */
	public function getBody() : array
	{
		return [];
	}

	/**
	 * @return array
	 */
	public function getOptions() : array
	{
		return array_merge($this->required, $this->optional);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	protected function configureOptions(OptionsResolver $resolver)
	{
	}

	/**
	 * @return array
	 */
	protected function transformOptions() : array
	{
		return $this->getOptions();
	}
}
