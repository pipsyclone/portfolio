<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Icons\Heroicon;
use App\Models\Contacts as ContactsModel;

use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\Action;

use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\TextEntry;

use Filament\Notifications\Notification;

class Contacts extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $title = 'Contacts';
    protected string $view = 'filament.pages.contacts';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    public static function canAccess(): bool
    {
        return auth()->user()->can('ViewAny', ContactsModel::class);
    }

    protected static ?string $recordTitleAttribute = 'name';
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Email' => $record->email,
            'Subject' => $record->subject,
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactsModel::query())
            ->defaultSort('created_at', 'desc')
            ->poll('10s')
            ->deferloading()
            ->columns([
                TextColumn::make('name')
                    ->label('Nama'),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('subject')
                    ->label('Subjek'),
                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d F Y H:i:s'),
            ])
            ->actions([
                Action::make('view')
                    ->icon(Heroicon::Eye)
                    ->infolist([
                        Grid::make()
                            ->columns(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Nama'),
                                TextEntry::make('email')
                                    ->label('Email'),
                                TextEntry::make('created_at')
                                    ->label('Tanggal')
                                    ->dateTime('d F Y H:i:s'),
                            ]),
                        TextEntry::make('subject')
                            ->label('Subjek'),
                        TextEntry::make('message')
                            ->label('Pesan'),
                    ]),
                Action::make('delete')
                    ->icon(Heroicon::Trash)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Hapus')
                    ->modalDescription('Apakah Anda yakin ingin menghapus kontak ini?')
                    ->modalSubmitActionLabel('Hapus')
                    ->action(function (ContactsModel $record) {
                        $record->delete();
                        Notification::make()
                            ->title('Kontak berhasil dihapus')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
