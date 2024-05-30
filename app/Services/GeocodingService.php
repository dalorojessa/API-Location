<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeocodingService
{
    protected $client;
    protected $host;
    protected $apiKey;

    public function __construct($host, $apiKey)
    {
        $this->client = new Client();
        $this->host = $host;
        $this->apiKey = $apiKey;
    }

    public function geocodeAddress($address)
    {
        $address .= ', Philippines'; 
        $response = $this->client->request('GET', "https://{$this->host}/json?address=" . urlencode($address), [
            'headers' => [
                'X-RapidAPI-Host' => $this->host,
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

}
