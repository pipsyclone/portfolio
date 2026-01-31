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
                            ->disk('cloudinary')
                            ->directory('portfolio/settings')
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml'])
                            ->maxSize(512)
                            ->visibility('public')
                            ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                            ->afterStateHydrated(function ($component, $state) {
                                if ($state && ! str_contains($state, '/')) {
                                    $component->state(['portfolio/settings/'.$state]);
                                }
                            }),
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

        // Extract filename saja untuk app_favicon
        if (! empty($data['app_favicon'])) {
            $data['app_favicon'] = is_array($data['app_favicon'])
                ? basename($data['app_favicon'][array_key_first($data['app_favicon'])] ?? '')
                : basename($data['app_favicon']);
        }

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
