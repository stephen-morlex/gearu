<?php

namespace App\Filament\Widgets;

use App\Models\ExchangeRate;
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

            // Add dataset for buying rates
            $datasets[] = [
                'label' => $currency->code . ' Buying Rate',
                'data' => $buyingData->map(fn(TrendValue $value) => $value->aggregate),
                'borderColor' => 'green', // Green for buying rate
                'backgroundColor' => 'rgba(0, 255, 0, 0.1)', // Light green background
                'fill' => false,
            ];

            // Add dataset for selling rates
            $datasets[] = [
                'label' => $currency->code . ' Selling Rate',
                'data' => $sellingData->map(fn(TrendValue $value) => $value->aggregate),
                'borderColor' => 'red', // Red for selling rate
                'backgroundColor' => 'rgba(255, 0, 0, 0.1)', // Light red background
                'fill' => false,
            ];

            // Set labels (dates) from the first currency's data
            if (empty($labels)) {
                $labels = $buyingData->map(fn(TrendValue $value) => $value->date);
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
        return 'line'; // Use line chart
    }

    /**
     * Customize the chart options for better visualization.
     */
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'type' => 'time', // Use time scale for the x-axis
                    'time' => [
                        'unit' => 'day', // Display by day
                    ],
                ],
                'y' => [
                    'beginAtZero' => true, // Do not start the y-axis from zero
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => function ($context) {
                            $label = $context->dataset->label ?? '';
                            $value = $context->raw;
                            return "{$label}: {$value}";
                        },
                    ],
                ],
            ],
        ];
    }
}
