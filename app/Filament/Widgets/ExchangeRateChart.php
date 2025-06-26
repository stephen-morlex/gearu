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
        return \App\Models\Currency::pluck('name', 'id')->toArray();
    }

    protected function getData(): array
    {
        $currencyId = $this->filter;
        if (!$currencyId) {
            $currencyId = (string) \App\Models\Currency::query()->latest()->value('id');
        }
        $labels = [];
        $datasets = [];
        $weeks = [];

        // Collect all week start dates in the range
        $startDate = now()->subDays(90)->startOfWeek();
        $endDate = now();
        while ($startDate <= $endDate) {
            $weeks[] = $startDate->copy();
            $startDate->addWeek();
        }
        $labels = array_map(fn($date) => $date->format('M d'), $weeks);

        $buyingData = [];
        $sellingData = [];
        foreach ($weeks as $weekStart) {
            $weekEnd = $weekStart->copy()->endOfWeek();
            $rates = \App\Models\ExchangeRate::query()
                ->where('currency_id', $currencyId)
                ->whereBetween('date', [$weekStart->toDateString(), $weekEnd->toDateString()])
                ->get(['buying_rate', 'selling_rate']);
            $buyingData[] = $rates->avg('buying_rate') ?? 0;
            $sellingData[] = $rates->avg('selling_rate') ?? 0;
        }
        $currency = \App\Models\Currency::find($currencyId);
        $currencyName = $currency ? $currency->name : 'Currency';
        $datasets[] = [
            'label' => $currencyName . ' Buying',
            'data' => $buyingData,
            'borderColor' => '#36A2EB',
            'backgroundColor' => 'rgba(54,162,235,0.2)',
        ];
        $datasets[] = [
            'label' => $currencyName . ' Selling',
            'data' => $sellingData,
            'borderColor' => '#FF6384',
            'backgroundColor' => 'rgba(255,99,132,0.2)',
        ];

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}