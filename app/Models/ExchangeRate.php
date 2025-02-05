<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ExchangeRate extends Model
{
public $guarded = [];

public function currency(): BelongsTo
{
    return $this->belongsTo(Currency::class);
}

public static function compareRates($currencyId1, $currencyId2, $date)
    {
        $rate1 = self::where('currency_id', $currencyId1)->where('date', $date)->first();
        $rate2 = self::where('currency_id', $currencyId2)->where('date', $date)->first();

        if (!$rate1 || !$rate2) {
            return null;
        }

        return [
            'buying_rate_difference' => $rate1->buying_rate - $rate2->buying_rate,
            'selling_rate_difference' => $rate1->selling_rate - $rate2->selling_rate,
        ];
    }
}
