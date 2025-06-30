<?php

namespace App\Filament\Resources\Currencies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('emoji')
                    ->label('Emoji')
                    ->placeholder('e.g., 💵')
                    ->maxLength(8)
                    ->helperText('Enter a currency emoji (e.g., 💵, 💶)')
                    ->nullable(),
            ]);
    }
}