<?php

namespace App\Filament\Pages;
use Illuminate\Support\Facades\Storage;

use App\Models\Setting;

use Filament\Pages\Page;
use BackedEnum;

// Form Components
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;

use Filament\Actions\Action;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;

use Filament\Notifications\Notification;

class Settings extends Page
{
    protected string $view = 'filament.pages.settings';
    protected static ?string $title = 'Pengaturan Aplikasi';
    protected static ?string $slug = 'setting';

    // Sembunyikan dari sidebar
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasPermission('ViewAny:Setting');
    }

    public ?array $data = [];
    public function mount(): void
    {
        $setting = Setting::first();
        $this->form->fill([
            'app_name'                    => $setting?->app_name ?? 'Unit Layanan Terpadu',
            'app_name_short'              => $setting?->app_name_short ?? 'ULT LLDIKTI XIV',
            'app_color'                   => $setting?->app_color ?? '#00ff91',
            'app_logo'                    => is_array($setting?->app_logo)
                                                ? $setting->app_logo
                                                : (is_string($setting?->app_logo) && !empty($setting->app_logo)
                                                    ? [$setting->app_logo]  // konversi string lama ke array
                                                    : []),
            'app_favicon'                 => $setting?->app_favicon ?? '',
            'app_stempel'                 => $setting?->app_stempel ?? '',
            'app_background_login_image'  => $setting?->app_background_login_image ?? '',
            'youtube_link'                => $setting?->youtube_link ?? '',
            'instagram_link'              => $setting?->instagram_link ?? '',
            'tiktok_link'                 => $setting?->tiktok_link ?? '',
            'facebook_link'               => $setting?->facebook_link ?? '',
            'x_twitter_link'              => $setting?->x_twitter_link ?? '',
            'github_link'                 => $setting?->github_link ?? '',
            'linkedin_link'               => $setting?->linkedin_link ?? '',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->columns(1)
            ->components([
                Grid::make()
                    ->columns(2)
                    ->schema([
                        Section::make('Informasi Aplikasi')
                            ->schema([
                                TextInput::make('app_name')
                                    ->label('Nama Aplikasi')
                                    ->required()
                                    ->validationMessages([
                                        'required' => 'Nama aplikasi wajib diisi.',
                                    ]),
                                TextInput::make('app_name_short')
                                    ->label('Nama Singkat Aplikasi')
                                    ->required()
                                    ->validationMessages([
                                        'required' => 'Nama singkat aplikasi wajib diisi.',
                                    ]),
                            ]),
                        Section::make('Tampilan Aplikasi')
                            ->schema([
                                ColorPicker::make('app_color')
                                    ->label('Warna Utama Aplikasi')
                                    ->required()
                                    ->validationMessages([
                                        'required' => 'Warna utama aplikasi wajib diisi.',
                                    ]),
                            ]),
                    ]),
                Section::make('Media')
                    ->schema([
                        Grid::make()
                            ->columns(3)
                            ->schema([
                                FileUpload::make('app_logo')
                                    ->label('Logo Aplikasi')
                                    ->disk('public')
                                    ->directory('settings')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()      // bisa diurutkan
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/*'])
                                    ->helperText('Rekomendasi ukuran: 512x512px. Maksimal 2MB.')
                                    ->validationMessages([
                                        'image' => 'File yang diunggah harus berupa gambar.',
                                        'max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                                    ])
                                    ->deleteUploadedFileUsing(function (string $file) {
                                        Storage::disk('public')->delete($file);
                                    }),
                                FileUpload::make('app_favicon')
                                    ->label('Favicon Aplikasi')
                                    ->disk('public')
                                    ->directory('settings')
                                    ->image()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/*'])
                                    ->helperText('Rekomendasi ukuran: 192x192px. Maksimal 2MB.')
                                    ->validationMessages([
                                        'image' => 'File yang diunggah harus berupa gambar.',
                                        'max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                                    ]),
                                FileUpload::make('app_background_login_image')
                                    ->label('Background Login')
                                    ->disk('public')
                                    ->directory('settings')
                                    ->image()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/*'])
                                    ->helperText('Rekomendasi ukuran: 1200x800px. Maksimal 2MB.')
                                    ->validationMessages([
                                        'image' => 'File yang diunggah harus berupa gambar.',
                                        'max' => 'Ukuran file tidak boleh lebih dari 2MB.',
                                    ]),
                            ]),
                    ]),
                Section::make('Media Sosial')
                    ->schema([
                        TextInput::make('youtube_link')
                            ->label('Link YouTube')
                            ->url()
                            ->placeholder('https://www.youtube.com/channel/...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                        TextInput::make('instagram_link')
                            ->label('Link Instagram')
                            ->url()
                            ->placeholder('https://www.instagram.com/...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                        TextInput::make('tiktok_link')
                            ->label('Link TikTok')
                            ->url()
                            ->placeholder('https://www.tiktok.com/@...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                        TextInput::make('facebook_link')
                            ->label('Link Facebook')
                            ->url()
                            ->placeholder('https://www.facebook.com/...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                        TextInput::make('x_twitter_link')
                            ->label('Link X (Twitter)')
                            ->url()
                            ->placeholder('https://twitter.com/...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                        TextInput::make('github_link')
                            ->label('Link GitHub')
                            ->url()
                            ->placeholder('https://github.com/...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                        TextInput::make('linkedin_link')
                            ->label('Link Linkedin')
                            ->url()
                            ->placeholder('https://www.linkedin.com/in/...')
                            ->validationMessages([
                                'url' => 'Format URL tidak valid.',
                            ]),
                    ]),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $setting = Setting::first();
        $disk = Storage::disk('public');

        // File single fields
        $singleFileFields = ['app_favicon', 'app_background_login_image', 'app_stempel'];
        foreach ($singleFileFields as $field) {
            if ($setting && !empty($setting->{$field})) {
                $oldFile = $setting->{$field};
                $newFile = $data[$field] ?? null;
                if ($oldFile !== $newFile && $disk->exists($oldFile)) {
                    $disk->delete($oldFile);
                }
            }
        }

        // app_logo multiple — hapus file lama yang tidak ada di data baru
        if ($setting) {
            $oldLogos = is_array($setting->app_logo) ? $setting->app_logo : [];
            $newLogos = is_array($data['app_logo']) ? $data['app_logo'] : [];
            $deletedLogos = array_diff($oldLogos, $newLogos);
            foreach ($deletedLogos as $file) {
                if ($disk->exists($file)) {
                    $disk->delete($file);
                }
            }
        }

        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();

        $this->redirect(request()->header('Referer') ?? url()->current());
    }
}
