<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all currencies
        $currencies = Currency::all();

        // Define the date range (2 months from December 2024 to today)
        $startDate = Carbon::create(2024, 12, 1); // December 1, 2024
        $endDate = Carbon::today(); // Today's date

        // Loop through each day in the date range
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Loop through each currency
            foreach ($currencies as $currency) {
                // Generate random buying and selling rates (for demonstration purposes)
                $buyingRate = $this->generateRandomRate($currency->code);
                $sellingRate = $buyingRate - mt_rand(1, 10); // Selling rate is slightly lower than buying rate

                // Create an exchange rate record
                ExchangeRate::create([
                    'date' => $date->toDateString(),
                    'currency_id' => $currency->id,
                    'buying_rate' => $buyingRate,
                    'selling_rate' => $sellingRate,
                ]);
            }
        }
    }

    /**
     * Generate a random exchange rate based on the currency code.
     */
    protected function generateRandomRate(string $currencyCode): float
    {
        // Base rates for demonstration purposes
        $baseRates = [
            'USD' => 100, // 1 USD = 100 KSH
            'EUR' => 120, // 1 EUR = 120 KSH
            'GBP' => 140, // 1 GBP = 140 KSH
        ];

        // Add some random fluctuation to the base rate
        return $baseRates[$currencyCode] + mt_rand(-5, 5);
    }
}