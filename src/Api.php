<?php

declare(strict_types=1);

namespace Overfair\StatGovSDK;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Api
{
    public const LANG_RU = 'ru';
    public const LANG_KK = 'kk';
    public const LANG_EN = 'en';

    public const LANGS = [
        self::LANG_RU,
        self::LANG_KK,
        self::LANG_EN,
    ];

    /**
     * @var Client
     */
    public Client $client;

    /**
     * @var int
     */
    public int $request_timeout = 10;

    /**
     * @var int
     */
    public int $connect_timeout = 7;

    /**
     * @var string
     */
    public string $default_language = self::LANG_RU;

    /**
     * Api constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }



    /**
     * @param string $method
     * @param array|null $params
     * @return array
     * @throws Exceptions\ApiException
     * @throws GuzzleException
     */
    public function request(string $method, array $params = null): array
    {
        $uri = "https://stat.gov.kz/api/$method";

        if ($params !== null)
        {
            $uri .= '?' . http_build_query($params);
        }

        $response = $this->client->get($uri, [
            RequestOptions::TIMEOUT => $this->request_timeout,
            RequestOptions::CONNECT_TIMEOUT => $this->connect_timeout,
        ]);

        $response_content = $response->getBody()->getContents();
        $decoded = json_decode($response_content, true,  512, JSON_THROW_ON_ERROR);
        if ($decoded['success'] !== true) {
            throw new Exceptions\ApiException($decoded['description']);
        }

        return $decoded['obj'];
    }

    /**
     * @param string $biin
     * @param string|null $language
     * @return Organization
     * @throws Exceptions\ApiException
     * @throws GuzzleException
     */
    public function getOrganization(string $biin, string $language = null): array //Organization
    {
        $response = $this->request('juridical/counter/api', [
            'bin' => $biin,
            'lang' => $language ?? $this->default_language,
        ]);
        return $response;
        return new Organization($response);
    }

}