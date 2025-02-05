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
        $currencies = Currency::take(4)->get();

        // Initialize datasets and labels
        $datasets = [];
        $labels = [];
        $allValues = [];

        // Define the date column to use for filtering and grouping
        $dateColumn = 'date';

        // Define colors for the datasets
        $buyingColors = [
            ['borderColor' => '#3f3cbb', 'backgroundColor' => 'rgba(63, 60, 187, 0.1)'],
            ['borderColor' => '#78dcca', 'backgroundColor' => 'rgba(120, 220, 202, 0.1)'],
            ['borderColor' => '#3ab7bf', 'backgroundColor' => 'rgba(58, 183, 191, 0.1)'],
            // Add more colors as needed
        ];

        $sellingColors = [
            ['borderColor' => 'red', 'backgroundColor' => 'rgba(255, 0, 0, 0.1)'],
            ['borderColor' => 'orange', 'backgroundColor' => 'rgba(255, 165, 0, 0.1)'],
            ['borderColor' => 'yellow', 'backgroundColor' => 'rgba(255, 255, 0, 0.1)'],
            // Add more colors as needed
        ];

        // Loop through each currency
        foreach ($currencies as $index => $currency) {
            // Fetch buying rates for the currency
            $buyingQuery = ExchangeRate::query()->where('currency_id', $currency->id);
            $buyingData = Trend::query($buyingQuery)
                ->dateColumn($dateColumn) // Use the 'date' column for filtering
                ->between(now()->subMonths(1), now()) // Last 2 months
                ->perDay()
                ->average('buying_rate'); // Aggregate by average

            // Fetch selling rates for the currency
            $sellingQuery = ExchangeRate::query()->where('currency_id', $currency->id);
            $sellingData = Trend::query($sellingQuery)
                ->dateColumn($dateColumn) // Use the 'date' column for filtering
                ->between(now()->subMonths(1), now()) // Last 2 months
                ->perDay()
                ->average('selling_rate'); // Aggregate by average

            // Get colors for the current currency
            $buyingColor = $buyingColors[$index % count($buyingColors)];
            $sellingColor = $sellingColors[$index % count($sellingColors)];

            // Add dataset for buying rates
            $datasets[] = [
                'label' => $currency->code . ' Buying Rate',
                'data' => $buyingData->map(fn(TrendValue $value) => $value->aggregate - 0.5),
                'borderColor' => $buyingColor['borderColor'], // Dynamic color for buying rate
                'backgroundColor' => $buyingColor['backgroundColor'], // Dynamic background color
                'fill' => true, // Fill the area under the line

             ];

            // Add dataset for selling rates
            $datasets[] = [
                'label' => $currency->code . ' Selling Rate',
                'data' => $sellingData->map(fn(TrendValue $value) => $value->aggregate - 0.5),
                'borderColor' => $sellingColor['borderColor'], // Dynamic color for selling rate
                'backgroundColor' => $sellingColor['backgroundColor'], // Dynamic background color
                'fill' => true, // Fill the area under the line

            ];

            // Collect all values for y-axis min calculation
            $allValues = array_merge($allValues, $buyingData->pluck('aggregate')->toArray(), $sellingData->pluck('aggregate')->toArray());

            // Set labels (dates) from the first currency's data
            if (empty($labels)) {
                $labels = $buyingData->map(fn(TrendValue $value) => $value->date);
            }
        }

        // Calculate the minimum value for the y-axis
        $minValue = min($allValues);

        return [
            'datasets' => $datasets,
            'labels' => $labels,
            'minValue' => $minValue,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Use line chart
    }

    public function getColumnSpan(): int
    {
        return 2; // Full-width layout
    }

    /**
     * Customize the chart options for better visualization.
     */
    protected function getOptions(): array
    {
        $data = $this->getData();
        $minValue = $data['minValue'];

        return [
            'scales' => [
                'x' => [
                    'type' => 'time', // Use time scale for the x-axis
                    'time' => [
                        'unit' => 'day', // Display by day
                    ],
                ],
                'y' => [
                    'beginAtZero' => false, // Do not start the y-axis from zero
                    'min' => $minValue, // Start y-axis from the first data value
                ],
            ],
            // 'plugins' => [
            //     'tooltip' => [
            //         'callbacks' => [
            //             'label' => function($tooltipItem) {
            //                 return $tooltipItem->dataset->label . ': ' . $tooltipItem->raw;
            //             },
            //             'title' => function($tooltipItems) {
            //                 return 'Date: ' . $tooltipItems[0]->label;
            //             },
            //         ],
            //     ],
            // ],
        ];
    }
}
