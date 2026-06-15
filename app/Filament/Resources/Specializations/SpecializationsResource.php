<?php

namespace App\Filament\Resources\Specializations;

use App\Filament\Resources\Specializations\Pages\CreateSpecializations;
use App\Filament\Resources\Specializations\Pages\EditSpecializations;
use App\Filament\Resources\Specializations\Pages\ListSpecializations;
use App\Filament\Resources\Specializations\Schemas\SpecializationsForm;
use App\Filament\Resources\Specializations\Tables\SpecializationsTable;
use App\Models\Specializations;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpecializationsResource extends Resource
{
    protected static ?string $model = Specializations::class;

    protected static string|BackedEnum|null $navigationIcon = null;
    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    public static function canAccess(): bool {
        return auth()->user()->can('ViewAny', Specializations::class);
    }

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SpecializationsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpecializationsTable::configure($table);
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
            'index' => ListSpecializations::route('/'),
            'create' => CreateSpecializations::route('/create'),
            'edit' => EditSpecializations::route('/{record}/edit'),
        ];
    }
}
