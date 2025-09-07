<?php

namespace App\Filament\Resources\Prompts\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PromptForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('prompt')
                    ->required()
                    ->rows(10)
                    ->columnSpanFull(),
                Repeater::make('placeholders')
                    ->schema([
                        TextInput::make('placeholder')->required(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
