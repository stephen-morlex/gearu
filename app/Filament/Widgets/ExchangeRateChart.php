<?php

namespace App\Filament\Widgets;

use App\Models\ExchangeRate;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ExchangeRateChart extends ChartWidget
{
    protected static ?string $heading = 'Exchange Rates Over Time';

    protected function getData(): array
    {
        $usdData = Trend::model(ExchangeRate::class)
            ->between(now()->subMonth(), now())
            ->perDay()
            // ->where('currency', 'GBP')
            ->sum('buying_rate');

        $eurData = Trend::model(ExchangeRate::class)
            ->between(now()->subMonth(), now())
            ->perDay()
            // ->where('currency', 'EUR')
            ->sum('buying_rate');

        return [
            'datasets' => [
                [
                    'label' => 'USD Buying Rate',
                    'data' => $usdData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                ],
                [
                    'label' => 'EUR Buying Rate',
                    'data' => $eurData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                ],
            ],
            'labels' => $usdData->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}