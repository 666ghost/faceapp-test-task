<?php


namespace Database\Seeders;


use App\Models\Currency;
use App\Services\ExchangeRateApiService;

class CurrenciesTableSeeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $exchangeRates = (new ExchangeRateApiService())->getAllRates();
        $currencies = array();
        foreach ($exchangeRates["rates"] as $currency => $rate) {
            $currencies[] = ["name" => $currency];
        }
        Currency::query()->insert($currencies);
    }
}
