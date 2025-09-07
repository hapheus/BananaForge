<?php

namespace App\Filament\Resources\Generations;

use App\Filament\Resources\Generations\Pages\CreateGeneration;
use App\Filament\Resources\Generations\Pages\EditGeneration;
use App\Filament\Resources\Generations\Pages\ListGenerations;
use App\Filament\Resources\Generations\Schemas\GenerationForm;
use App\Filament\Resources\Generations\Tables\GenerationsTable;
use App\Models\Generation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GenerationResource extends Resource
{
    protected static ?string $model = Generation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return GenerationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GenerationsTable::configure($table);
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
            'index' => ListGenerations::route('/'),
            'create' => CreateGeneration::route('/create'),
            'edit' => EditGeneration::route('/{record}/edit'),
        ];
    }
}
