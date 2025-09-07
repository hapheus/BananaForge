<?php

namespace App\Filament\Resources\Images\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ImageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('role'),
                TextEntry::make('generation.title'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
