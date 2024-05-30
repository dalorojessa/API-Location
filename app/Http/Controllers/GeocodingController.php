<?php

namespace App\Http\Controllers;

use App\Services\GeocodingService;
use Illuminate\Http\Request;

class GeocodingController extends Controller
{
    protected $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    public function geocode(Request $request)
    {
        $address = $request->input('address');
        
        if (stripos($address, 'Philippines') === false) {
            return response()->json(['error' => 'Address must be in the Philippines.'], 400);
        }

        $result = $this->geocodingService->geocodeAddress($address);

        return response()->json($result);
    }

}

