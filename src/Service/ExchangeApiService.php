<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExchangeApiService
{
    private $client;
    private $params;

    public function __construct(HttpClientInterface $client, ParameterBagInterface $params)
    {
        $this->client = $client;
        $this->params = $params;
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param float $amount
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     *
     * Ccrida a la api de exchangerate per obtenir la conversio en la moneda especificada
     */
    public function fetchDataFromApi(string $currencyFrom, string $currencyTo, float $amount): array
    {
        try {
            //print_r($this->params);
            //die();
        $urlBase = $this->params->get('URL_API_EXCHANGERATE');
        $apiKey = $this->params->get('APIKEY_EXCHANGERATE');

        $url = str_replace(['[APIKEY]','[CURRENCYFROM]','[CURRENCYTO]','[AMOUNT]'], [$apiKey, $currencyFrom, $currencyTo, $amount], $urlBase);

        $response = $this->client->request('GET', $url);

        return $response->toArray();
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];

        }
    }
}