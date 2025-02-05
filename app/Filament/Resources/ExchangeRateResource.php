<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeRateResource\Pages;
use App\Filament\Resources\ExchangeRateResource\RelationManagers;
use App\Models\ExchangeRate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class ExchangeRateResource extends Resource
{
    protected static ?string $model = \App\Models\ExchangeRate::class;
    protected static ?string $navigationLabel = 'Exchange Rates';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('currency_id')
                ->relationship('currency', 'code')
                ->required(),
                Forms\Components\DatePicker::make('date')
                ->required(),

            Forms\Components\TextInput::make('buying_rate')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('selling_rate')
                ->numeric()
                ->required(),
        ]);
    }
    public static function compareCurrencies($currencyId1, $currencyId2, $date)
    {
        return ExchangeRate::compareRates($currencyId1, $currencyId2, $date);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('date')
                ->sortable(),
            Tables\Columns\TextColumn::make('currency.code')
                ->label('Currency')
                ->sortable(),
            Tables\Columns\TextColumn::make('buying_rate')
                ->label('Buying Rate (100 Foreign Currency)')
                ->numeric(),
            Tables\Columns\TextColumn::make('selling_rate')
                ->label('Selling Rate (100 Foreign Currency)')
                ->numeric(),
        ])
        ->filters([
            // Add filters if needed
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeRates::route('/'),
            'create' => Pages\CreateExchangeRate::route('/create'),
            'edit' => Pages\EditExchangeRate::route('/{record}/edit'),
        ];
    }
}
