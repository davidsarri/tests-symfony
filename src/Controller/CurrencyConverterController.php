<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ExchangeApiService;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @Route("/currencyconverter", name="app_currency_converter")
 */
class CurrencyConverterController extends AbstractController
{
    private $exchangeApiService;

    public function __construct(ExchangeApiService $exchangeApiService) {
        $this->exchangeApiService = $exchangeApiService;
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param float $amount
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @Route("/convert/{currencyFrom}/{currencyTo}/{amount}", name="app_currency_converter")
     *
     * Crida al servei que obté dades de l'api de ExchangeApi per realitzar un canvi de divises
     */



    public function index(string $currencyFrom, string $currencyTo, float $amount): Response
    {
        try{
            $response = $this->exchangeApiService->fetchDataFromApi($currencyFrom, $currencyTo, $amount);

            if(isset($response['error'])) {
                $returnText = "ERROR: ".$response['error'];
            } else {
                $returnText = "Resultat de la conversio: ".$response['conversion_result'];
            }

            return new Response($returnText);
        }catch (\Exception $exception) {
            $returnText = "ERROR: ".$exception->getMessage();
        }

        return new Response($returnText);
    }
}
