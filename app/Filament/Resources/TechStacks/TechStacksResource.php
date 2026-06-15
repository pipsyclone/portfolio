<?php

namespace App\Filament\Resources\TechStacks;

use App\Filament\Resources\TechStacks\Pages\CreateTechStacks;
use App\Filament\Resources\TechStacks\Pages\EditTechStacks;
use App\Filament\Resources\TechStacks\Pages\ListTechStacks;
use App\Filament\Resources\TechStacks\Schemas\TechStacksForm;
use App\Filament\Resources\TechStacks\Tables\TechStacksTable;
use App\Models\TechStacks;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TechStacksResource extends Resource
{
    protected static ?string $model = TechStacks::class;

    protected static string|BackedEnum|null $navigationIcon = null;
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    public static function canAccess(): bool {
        return auth()->user()->can('ViewAny', TechStacks::class);
    }

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TechStacksForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TechStacksTable::configure($table);
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
            'index' => ListTechStacks::route('/'),
            'create' => CreateTechStacks::route('/create'),
            'edit' => EditTechStacks::route('/{record}/edit'),
        ];
    }
}
