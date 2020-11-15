<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class ExchangeRateApiService
{
    public function getAllRates(): ?array
    {
        $client = new Client(["base_uri" => "https://api.exchangerate.host/",]);
        try {
            $response = $client->request("GET", "/latest?base=RUB");
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return null;
        }

        $data = json_decode($response->getBody(), true);
        if (!$data["success"]) {
            Log::error("https://api.exchangerate.host/ returns success=false");
            abort(500);
        }
        return $data;
    }

}
