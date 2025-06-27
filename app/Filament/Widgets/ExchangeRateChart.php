<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\DB;

class ExchangeRateChart extends ChartWidget
{
    protected ?string $heading = 'SSP Exchange Rate Chart';
    public ?string $filter = null;
    protected bool $isCollapsible = true;

    protected function getFilters(): ?array
    {
        $currencies = \App\Models\Currency::pluck('name', 'id')->toArray();
        return ['all' => 'Default currency'] + $currencies;
    }

    protected function getData(): array
    {
        // Get the first currency as default if no filter is set
        $defaultCurrency = \App\Models\Currency::first();
        $currencyId = $this->filter ?? ($defaultCurrency ? $defaultCurrency->id : null);

        if (!$currencyId) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        // Get exchange rates for the selected currency
        $rates = \App\Models\ExchangeRate::query()
            ->where('currency_id', $currencyId)
            ->where('date', '>=', now()->subDays(30)->toDateString())
            ->orderBy('date')
            ->get(['date', 'buying_rate', 'selling_rate']);

        if ($rates->isEmpty()) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $labels = $rates->pluck('date')->map(fn($date) => date('M d', strtotime($date)))->toArray();
        $buyingData = $rates->pluck('buying_rate')->toArray();
        $sellingData = $rates->pluck('selling_rate')->toArray();

        $currency = \App\Models\Currency::find($currencyId);
        $currencyName = $currency ? $currency->name : 'Currency';

        return [
            'datasets' => [
                [
                    'label' => $currencyName . ' Buying',
                    'data' => $buyingData,
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => 'rgba(54,162,235,0.2)',
                ],
                [
                    'label' => $currencyName . ' Selling',
                    'data' => $sellingData,
                    'borderColor' => '#FF6384',
                    'backgroundColor' => 'rgba(255,99,132,0.2)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}