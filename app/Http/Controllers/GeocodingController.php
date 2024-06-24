<?php

// Define the namespace for this controller class to organize the code
namespace App\Http\Controllers;

// Import the GeocodingService 
use App\Services\GeocodingService;
// Import the base controller class
use Illuminate\Http\Request;

// Define the GeocodingController class that extends the BaseController class
class GeocodingController extends Controller
{
    // Define a protected property to hold an instance of GeocodingService
    protected $geocodingService;

    // Define the constructor from the GeocodingService class
    public function __construct(GeocodingService $geocodingService)
    {
        // Assign the received geocodingService instance to the protected property
        $this->geocodingService = $geocodingService;
    }

    // Define a method that will handle HTTP requests to geocode an address
    public function geocode(Request $request)
    {
        // Retrieve the 'address' input from the request
        $address = $request->input('address');
        
        // Check if the address contains the string 'Philippines'
        if (stripos($address, 'Philippines') === false) {
            // If not, return a JSON response with an error message and a 400 status code
            return response()->json(['error' => 'Address must be in the Philippines.'], 400);
        }

        // Call the geocodeAddress method of the geocodingService instance, passing the address to retrieve the geocoding data
        $result = $this->geocodingService->geocodeAddress($address);

        // Return the geocoding data as a JSON response
        return response()->json($result);
    }

}

