<?php

namespace App\Filament\Resources\Images;

use App\Filament\Resources\Images\Pages\CreateImage;
use App\Filament\Resources\Images\Pages\EditImage;
use App\Filament\Resources\Images\Pages\ListImages;
use App\Filament\Resources\Images\Pages\ViewImage;
use App\Filament\Resources\Images\Schemas\ImageForm;
use App\Filament\Resources\Images\Schemas\ImageInfolist;
use App\Filament\Resources\Images\Tables\ImagesTable;
use App\Models\Image;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'path';

    public static function form(Schema $schema): Schema
    {
        return ImageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ImageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ImagesTable::configure($table);
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
            'index' => ListImages::route('/'),
            'create' => CreateImage::route('/create'),
            'view' => ViewImage::route('/{record}'),
            'edit' => EditImage::route('/{record}/edit'),
        ];
    }
}
