<?php

namespace App\Filament\Widgets;

use App\Models\ExchangeRate;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class LatestRate extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => ExchangeRate::query()->latest())
            ->columns([
                TextColumn::make('date')->date()->label('Date'),
                TextColumn::make('currency.name')->label('Currency'),
                TextColumn::make('buying_rate')->label('Buying Rate'),
                TextColumn::make('selling_rate')->label('Selling Rate'),
                TextColumn::make('user.name')->label('User'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}