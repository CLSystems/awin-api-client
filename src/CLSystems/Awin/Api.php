<?php

namespace CLSystems\Awin;

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
	 * @return Api
	 */
	public function getClient() : Api
	{
		if (true === empty($this->httpClient))
		{
			$this->httpClient = new Client([
				'base_uri' => self::AWIN_API_ENDPOINT,
				'headers'  => [
					'Authorization' => sprintf('Bearer %s', $this->apiToken),
					'Accept'        => 'application/json',
				],
			]);
		}

		return $this;
	}

	/**
	 * Get programs from Awin API
	 * @see https://wiki.awin.com/index.php/API_get_programmes
	 *
	 * @param int $publisherId
	 * @param array $params
	 * @return array
	 */
	public function getPrograms(int $publisherId, array $params = []) : array
	{
		$httpquery = http_build_query(array_merge([
//				'api_key'      => $this->apiKey,
//				'affiliate_id' => $this->affiliateId
			] + $params));

		$url = self::AWIN_API_ENDPOINT . '/publishers/' . $publisherId . '/programmes?' . $httpquery;
		var_dump($url);
		$response = $this->httpClient->get($url)->getBody()->getContents();
		$result = json_decode($response, true);

		if (false === $result)
		{
			echo 'Error in response: ' . var_export($response, true);
			return [];
		}
		return $result;
	}


	/**
	 * Get program detailss from Awin API
	 * @see https://wiki.awin.com/index.php/API_get_programmedetails
	 *
	 * @param int $programId
	 * @param array $params
	 * @return array
	 */
	public function getProgramDetails(int $publisherId, int $programId, array $params = []) : array
	{
		$httpquery = http_build_query(array_merge([
				'advertiserId' => $programId,
				//				'affiliate_id' => $this->affiliateId
			] + $params));

		$url = self::AWIN_API_ENDPOINT . '/publishers/' . $publisherId . '/programmedetails?' . $httpquery;
		var_dump($url);
		$response = $this->httpClient->get($url)->getBody()->getContents();
		$result = json_decode($response, true);

		if (false === $result)
		{
			echo 'Error in response: ' . var_export($response, true);
			return [];
		}
		return $result;
	}

}