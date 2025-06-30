<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Currency;
use App\Models\ExchangeRate;

class CurrencyMatrixTable extends Component
{
    public $currencies;
    public $matrix = [];
    public $showType = 'both'; // 'buying', 'selling', 'both'

    public function toggleType($type)
    {
        $this->showType = $type;
    }

    public function mount()
    {
        $this->currencies = Currency::orderBy('code')->get();
        $currencyIds = $this->currencies->pluck('id');
        $today = now();
        $startDate = $today->copy()->subDays(6)->startOfDay();

        // Build matrix: [from_id][to_id] = [ [date, buying, selling, buying_direction, selling_direction], ... ]
        foreach ($this->currencies as $from) {
            foreach ($this->currencies as $to) {
                if ($from->id === $to->id) {
                    $history = [];
                    for ($i = 0; $i < 7; $i++) {
                        $date = $startDate->copy()->addDays($i)->toDateString();
                        $history[] = [
                            'date' => $date,
                            'buying' => 1,
                            'selling' => 1,
                            'buying_direction' => 'same',
                            'selling_direction' => 'same',
                        ];
                    }
                    $this->matrix[$from->id][$to->id] = $history;
                } else {
                    // Get up to 7 most recent rates for this pair, ordered by date asc
                    $rates = ExchangeRate::where('currency_id', $to->id)
                        ->whereBetween('date', [$startDate->toDateString(), $today->toDateString()])
                        ->orderBy('date')
                        ->get();
                    $history = [];
                    $prev = null;
                    foreach ($rates as $rate) {
                        $buying_direction = 'same';
                        $selling_direction = 'same';
                        if ($prev) {
                            if ($rate->buying_rate > $prev->buying_rate) {
                                $buying_direction = 'up';
                            } elseif ($rate->buying_rate < $prev->buying_rate) {
                                $buying_direction = 'down';
                            }
                            if ($rate->selling_rate > $prev->selling_rate) {
                                $selling_direction = 'up';
                            } elseif ($rate->selling_rate < $prev->selling_rate) {
                                $selling_direction = 'down';
                            }
                        }
                        $history[] = [
                            'date' => $rate->date,
                            'buying' => $rate->buying_rate,
                            'selling' => $rate->selling_rate,
                            'buying_direction' => $buying_direction,
                            'selling_direction' => $selling_direction,
                        ];
                        $prev = $rate;
                    }
                    // Fill missing days with nulls or dashes
                    $historyByDate = collect($history)->keyBy('date');
                    $fullHistory = [];
                    for ($i = 0; $i < 7; $i++) {
                        $date = $startDate->copy()->addDays($i)->toDateString();
                        if (isset($historyByDate[$date])) {
                            $fullHistory[] = $historyByDate[$date];
                        } else {
                            $fullHistory[] = [
                                'date' => $date,
                                'buying' => null,
                                'selling' => null,
                                'buying_direction' => null,
                                'selling_direction' => null,
                            ];
                        }
                    }
                    $this->matrix[$from->id][$to->id] = $fullHistory;
                }
            }
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
           loading...
        </div>
        HTML;
    }
    public function render()
    {
        return view('livewire.currency-matrix-table', [
            'currencies' => $this->currencies,
            'matrix' => $this->matrix,
        ]);
    }
}