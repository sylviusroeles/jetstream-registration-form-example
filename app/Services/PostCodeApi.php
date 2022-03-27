<?php

namespace App\Services;

use Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

class PostCodeApi
{
    const BASE_URL = 'https://sandbox.postcodeapi.nu';
    const API_KEY_HEADER = 'X-Api-Key';

    /**
     * @var Client
     */
    public Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri'    => self::BASE_URL,
            'headers'     => [
                self::API_KEY_HEADER => env('POSTCODEAPI_KEY'),
            ],
            'http_errors' => false,
        ]);
    }

    /**
     * @param string $postalCode
     * @param string $houseNumber
     * @return mixed|null
     * @throws GuzzleException
     */
    public function getAddress(string $postalCode, string $houseNumber)
    {
        if($address = Cache::get("address-$postalCode-$houseNumber"))
            return $address;

        $response = $this->client->get("/v3/lookup/$postalCode/$houseNumber");

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            return null;
        }

        $address = json_decode($response->getBody()->getContents(), true);
        Cache::put("address-$postalCode-$houseNumber", $address);

        return $address;
    }
}
