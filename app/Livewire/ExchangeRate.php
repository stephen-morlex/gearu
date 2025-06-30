<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Currency;
use App\Models\ExchangeRate as ExchangeRateModel;

class ExchangeRate extends Component
{
    public $chartData = [];
    public $tableData = [];
    public $currencies = [];

    public function mount()
    {
        $ssp = Currency::where('code', 'SSP')->first();
        $this->currencies = Currency::where('code', '!=', 'SSP')->get();
        $dates = collect(range(0, 6))->map(function ($i) {
            return now()->subDays($i)->toDateString();
        })->reverse()->values();

        // Chart data: for each currency, get daily rates against SSP
        $chartData = [];
        foreach ($this->currencies as $currency) {
            $rates = ExchangeRateModel::where('currency_id', $currency->id)
                ->whereIn('date', $dates)
                ->orderBy('date')
                ->get(['date', 'buying_rate', 'selling_rate']);
            $chartData[$currency->code] = $rates->keyBy('date')->toArray();
        }
        $this->chartData = $chartData;

        // Table data: for each currency, get today's rate against SSP
        $today = now()->toDateString();
        $tableData = [];
        foreach ($this->currencies as $currency) {
            $rate = ExchangeRateModel::where('currency_id', $currency->id)
                ->where('date', $today)
                ->first();
            $tableData[] = [
                'currency' => $currency,
                'buying_rate' => $rate->buying_rate ?? '-',
                'selling_rate' => $rate->selling_rate ?? '-',
            ];
        }
        $this->tableData = $tableData;
    }

    public function render()
    {
        return view('livewire.exchange-rate', [
            'chartData' => $this->chartData,
            'tableData' => $this->tableData,
            'currencies' => $this->currencies,
        ]);
    }
}