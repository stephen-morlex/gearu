<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ExchangeRate;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exchange-rates', ExchangeRate::class);
