<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
// Form Components
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Settings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = null;

    protected string $view = 'filament.pages.settings';

    protected static ?string $title = 'Pengaturan Aplikasi';

    protected static ?string $slug = 'settings';

    // Sembunyikan dari sidebar
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();

        $this->form->fill([
            'app_name' => $setting?->app_name ?? config('app.name'),
            'app_favicon' => $setting?->app_favicon,
            'theme_color' => $setting?->theme_color ?? '#6366f1',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Identitas Aplikasi')
                    ->schema([
                        TextInput::make('app_name')
                            ->label('Nama Aplikasi')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('theme_color')
                            ->label('Warna Tema')
                            ->type('color')
                            ->required(),
                    ]),
                Section::make('Asset Aplikasi')
                    ->schema([
                        FileUpload::make('app_favicon')
                            ->label('Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml'])
                            ->maxSize(512),
                    ]),
            ])->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Gunakan query builder karena tabel tidak punya primary key
        \App\Models\Setting::query()->update($data);

        // Clear singleton cache agar perubahan terlihat
        app()->forgetInstance('app.setting');

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
