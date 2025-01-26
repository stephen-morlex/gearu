<?php

namespace App\Filament\Widgets;

use \App\Models\ExchangeRate;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Currency;
class ExchangeRateChart extends ChartWidget
{
    protected static ?string $heading = 'Exchange Rates Over Time';

    protected function getData(): array
    {
        // Fetch all currencies
        $currencies = Currency::all();

        // Initialize datasets and labels
        $datasets = [];
        $labels = [];

        // Define the date column to use for filtering and grouping
        $dateColumn = 'date';

        // Loop through each currency
        foreach ($currencies as $currency) {
            // Fetch buying rates for the currency
            $buyingQuery = ExchangeRate::query()->where('currency_id', $currency->id);
            $buyingData = Trend::query($buyingQuery)
                ->dateColumn($dateColumn) // Use the 'date' column for filtering
                ->between(now()->subMonths(2), now()) // Last 2 months
                ->perDay()
                ->sum('buying_rate');

            // Fetch selling rates for the currency
            $sellingQuery = ExchangeRate::query()->where('currency_id', $currency->id);
            $sellingData = Trend::query($sellingQuery)
                ->dateColumn($dateColumn) // Use the 'date' column for filtering
                ->between(now()->subMonths(2), now()) // Last 2 months
                ->perDay()
                ->sum('selling_rate');

            // Combine buying and selling rates into floating bar data
            $floatingBarData = $buyingData->map(function (TrendValue $value, $index) use ($sellingData) {
                return [
                    $sellingData[$index]->aggregate, // Selling rate
                    $value->aggregate, // Buying rate
                ];
            });

            // Add dataset for the currency
            $datasets[] = [
                'label' => $currency->code . ' Exchange Rate Range',
                'data' => $floatingBarData,
                'backgroundColor' => $this->getColorForCurrency($currency->code),
            ];

            // Set labels (dates) from the first currency's data
            if (empty($labels)) {
                $labels = $buyingData->map(fn (TrendValue $value) => $value->date);
            }
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    public function getColumnSpan(): int
    {
        return 2; // Full-width layout
    }
    protected function getType(): string
    {
        return 'bar'; // Use floating bar chart
    }
    
    /**
     * Get a unique color for each currency.
     */
    protected function getColorForCurrency(string $currencyCode): string
    {
        $colors = [
            'USD' => 'red', // Teal for USD
            'EUR' => 'blue', // Red for EUR
            'GBP' => 'green', // Blue for GBP
            // Add more colors as needed
        ];

        return $colors[$currencyCode] ?? 'rgba(201, 203, 207, 0.6)'; // Default gray
    }

    /**
     * Customize the chart options for floating bars.
     */
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'stacked' => true, // Stack bars on the x-axis
                ],
                'y' => [
                    'beginAtZero' => false, // Do not start the y-axis from zero
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => function ($context) {
                            $label = $context->dataset->label ?? '';
                            $sellingRate = $context->raw[0];
                            $buyingRate = $context->raw[1];
                            return "{$label}: {$sellingRate} - {$buyingRate}";
                        },
                    ],
                    'fill' => 'sky',
                ],
            ],
        ];
    }

}