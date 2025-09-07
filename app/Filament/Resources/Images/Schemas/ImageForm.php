<?php

namespace App\Filament\Resources\Images\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('role')
                    ->required(),
                Select::make('generation_id')
                    ->relationship('generation', 'title')
                    ->required(),
                Textarea::make('path')
                    ->required()
                    ->columnSpanFull(),

            ]);
    }
}
