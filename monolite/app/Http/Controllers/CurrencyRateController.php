<?php


namespace App\Http\Controllers;


use App\Http\Resources\ExchangeRateHistoryResource;
use App\Http\Resources\ExchangeRateResource;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\ExchangeRateHistory;
use App\Services\ExchangeRateApiService;
use Illuminate\Support\Facades\Log;

class CurrencyRateController
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function current()
    {
        $data = (new ExchangeRateApiService())->getAllRates();
        if ($data === null) {
            Log::error("Something went wrong when seeding currencies");
            return null;
        }
        $exchangeRateHistory = new ExchangeRateHistory();
        $exchangeRateHistory->save();

        foreach ($data["rates"] as $currency => $rate) {
            $currencyId = Currency::query()->where("name", $currency)->first()->id;
            ExchangeRate::query()->create(["rate" => $rate, "currency_id" => $currencyId,
                'history_id' => $exchangeRateHistory->id]);
        }
        $exchangeRates = ExchangeRate::query()->where("history_id", $exchangeRateHistory->id)->get();

        return ExchangeRateResource::collection($exchangeRates);
    }

    public function history()
    {
        return ExchangeRateHistoryResource::collection(ExchangeRateHistory::all());
    }
}
