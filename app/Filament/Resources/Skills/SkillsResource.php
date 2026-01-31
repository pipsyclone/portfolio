<?php

namespace App\Filament\Resources\Skills;

use App\Filament\Resources\Skills\Pages\CreateSkills;
use App\Filament\Resources\Skills\Pages\EditSkills;
use App\Filament\Resources\Skills\Pages\ListSkills;
use App\Filament\Resources\Skills\Schemas\SkillsForm;
use App\Filament\Resources\Skills\Tables\SkillsTable;
use App\Models\Skills;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SkillsResource extends Resource
{
    protected static ?string $model = Skills::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Briefcase;

    protected static UnitEnum|string|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Manajemen Keahlian';
    protected static ?string $modelLabel = 'Keahlian';

    public static function form(Schema $schema): Schema
    {
        return SkillsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SkillsTable::configure($table);
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
            'index' => ListSkills::route('/'),
            'create' => CreateSkills::route('/create'),
            'edit' => EditSkills::route('/{record}/edit'),
        ];
    }
}
