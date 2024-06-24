<?php

// Define the namespace for this service class to organize the code
namespace App\Services;

// Import the GuzzleHttp Client class for making HTTP requests
use GuzzleHttp\Client;

// Define the GeocodingService class that will handle geocoding operations
class GeocodingService
{
    // Declare a protected property to hold an instance of the Guzzle HTTP client
    protected $client;
    // Declare a protected property to hold the host URL for the weather API
    protected $host;
    // Declare a protected property to hold the API key for the RapidAPI service
    protected $apiKey;

    // Define the constructor for the GeocodingService class
    public function __construct($host, $apiKey)
    {
        // Initialize the Guzzle HTTP client
        $this->client = new Client();
        // Set the host URL for the geocoding API
        $this->host = $host;
        // Set the API key for the RapidAPI service
        $this->apiKey = $apiKey;
    }

    // Define a method that performs the geocoding operation for a given address
    public function geocodeAddress($address)
    {
        // Append ', Philippines' to the address to ensure it is specific to the Philippines
        $address .= ', Philippines'; 
        // Send an HTTP GET request to the geocoding API using the Guzzle client
        $response = $this->client->request('GET', "https://{$this->host}/json?address=" . urlencode($address), [
            'headers' => [
                // Set API host header
                'X-RapidAPI-Host' => $this->host,
                // Set API key header
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        // Decode JSON response and return as array
        return json_decode($response->getBody(), true);
    }

}
