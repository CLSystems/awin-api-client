<?php

namespace CLSystems\Awin;

use CLSystems\Awin\Http\Response;
use CLSystems\Awin\Request\GetAccountDefinition;
use CLSystems\Awin\Request\GetCommissionGroupsDefinition;
use CLSystems\Awin\Request\GetProgrammeDetailDefinition;
use CLSystems\Awin\Request\GetProgrammesDefinition;
use CLSystems\Awin\Request\GetTransactionsDefinition;
use CLSystems\Awin\Request\RequestDefinitionInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Api
 *
 * @package CLSystems\Awin
 */
class Api
{
	/**
	 * @const string
	 */
	const AWIN_API_ENDPOINT = 'https://api.awin.com';

	/**
	 * @var string
	 */
	private $apiToken;

	/**
	 * @var Client
	 */
	protected $httpClient;

	/**
	 * Constructor
	 *
	 * @param $apiToken
	 */
	public function __construct($apiToken)
	{
		$this->apiToken = $apiToken;
	}

	/**
	 * @return Client
	 */
	public function getClient() : Client
	{
		if (empty($this->httpClient))
		{
			$this->httpClient = new Client([
				'base_uri' => self::AWIN_API_ENDPOINT,
				'headers'  => ['Authorization' => sprintf('Bearer %s', $this->apiToken)],
			]);
		}

		return $this->httpClient;
	}

	/**
	 * @param RequestDefinitionInterface $definition
	 * @return Response
	 * @throws GuzzleException
	 */
	private function send(RequestDefinitionInterface $definition) : Response
	{
		$response = $this->getClient()->request(
			$definition->getMethod(),
			$definition->getUrl(),
			[
				'body' => json_encode($definition->getBody()),
			]
		);

		return new Response($response->getStatusCode(), $response->getBody()->getContents());
	}

	/**
	 * @doc http://wiki.awin.com/index.php/API_get_accounts
	 * @param array $options
	 * @return Response
	 * @throws GuzzleException
	 */
	public function getAccounts(array $options = []) : Response
	{
		return $this->send(new GetAccountDefinition($options));
	}

	/**
	 * @doc http://wiki.awin.com/index.php/API_get_programmes
	 * @param int $publisherId
	 * @param array $options
	 * @return Response
	 * @throws GuzzleException
	 */
	public function getProgrammes(int $publisherId, array $options = []) : Response
	{
		$options['publisherId'] = $publisherId;

		return $this->send(new GetProgrammesDefinition($options));
	}

	/**
	 * @doc http://wiki.awin.com/index.php/API_get_programmedetails
	 * @param int $publisherId
	 * @param array $options
	 * @return Response
	 * @throws GuzzleException
	 */
	public function getProgrammeDetail(int $publisherId, array $options = []) : Response
	{
		$options['publisherId'] = $publisherId;

		return $this->send(new GetProgrammeDetailDefinition($options));
	}

	/**
	 * @doc http://wiki.awin.com/index.php/API_get_commissiongroups
	 * @param int $publisherId
	 * @param array $options
	 * @return Response
	 * @throws GuzzleException
	 */
	public function getCommissionGroups(int $publisherId, array $options = []) : Response
	{
		$options['publisherId'] = $publisherId;

		return $this->send(new GetCommissionGroupsDefinition($options));
	}

	/**
	 * @doc http://wiki.awin.com/index.php/API_get_transactions_list
	 * @param int $publisherId
	 * @param array $options
	 * @return Http\Response
	 * @throws GuzzleException
	 */
	public function getTransactions(int $publisherId, array $options = []) : Response
	{
		$options['publisherId'] = $publisherId;

		return $this->send(new GetTransactionsDefinition($options));
	}

}