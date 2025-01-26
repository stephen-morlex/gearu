<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Currency extends Model
{
    public $guarded = [];

    public function exchangeRates(): HasMany
    {
        return $this->hasMany(ExchangeRate::class);
    }
}
