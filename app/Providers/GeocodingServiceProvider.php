<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GeocodingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\GeocodingService', function ($app) {
            return new \App\Services\GeocodingService(env('RAPIDAPI_HOST'), env('RAPIDAPI_KEY'));
        });
    }
}
