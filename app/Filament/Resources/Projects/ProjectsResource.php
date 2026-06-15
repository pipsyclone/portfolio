<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProjects;
use App\Filament\Resources\Projects\Pages\EditProjects;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Filament\Resources\Projects\Schemas\ProjectsForm;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Projects;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProjectsResource extends Resource
{
    protected static ?string $model = Projects::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    public static function canAccess(): bool
    {
        return auth()->user()->can('ViewAny', Projects::class);
    }

    protected static ?string $recordTitleAttribute = 'name';
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Description' => $record->description,
            'URL' => $record->url,
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return ProjectsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
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
            'index' => ListProjects::route('/'),
            'create' => CreateProjects::route('/create'),
            'edit' => EditProjects::route('/{record}/edit'),
        ];
    }
}
