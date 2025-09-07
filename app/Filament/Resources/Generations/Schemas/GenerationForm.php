<?php

namespace App\Filament\Resources\Generations\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GenerationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Select::make('prompt_id')
                    ->relationship('prompt', 'title')
                    ->required(),
                Repeater::make('input_values')
                    ->schema([
                        TextInput::make('placeholder')->required(),
                        TextInput::make('value')->required(),
                    ])
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required(),
            ]);
    }
}
