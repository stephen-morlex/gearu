<?php

namespace App\Filament\Resources\ExchangeRates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExchangeRateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                ->required(),
                TextInput::make('buying_rate')
                    ->required()
                    ->numeric(),
                TextInput::make('selling_rate')
                    ->required()
                    ->numeric(),
                Select::make('currency_id')
                    ->relationship(name: 'currency', titleAttribute: 'name')->ulid()
                    ->required(),
                Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'name')->ulid()
                    ->default(fn () => auth()->id())
                    ->required(),
            ]);
    }
}