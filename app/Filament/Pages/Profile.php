<?php

namespace App\Filament\Pages;

use App\Models\Profile as ProfileModel;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class Profile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = null;

    protected string $view = 'filament.pages.profile';

    protected static ?string $title = 'Profil Saya';

    protected static ?string $slug = 'profile';

    // Sembunyikan dari sidebar
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $profile = ProfileModel::first();

        $this->form->fill([
            'foto' => $profile?->foto,
            'name' => $profile?->name,
            'as' => $profile?->as,
            'bio' => $profile?->bio,
            'experience' => $profile?->experience,
            'cv_url' => $profile?->cv_url,
            'email' => $profile?->email,
            'phone' => $profile?->phone,
            'address' => $profile?->address,
            'github_url' => $profile?->github_url,
            'linkedin_url' => $profile?->linkedin_url,
            'twitter_url' => $profile?->twitter_url,
            'instagram_url' => $profile?->instagram_url,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->schema([
                        Section::make('Foto & Identitas')
                            ->schema([
                                FileUpload::make('foto')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->disk('cloudinary')
                                    ->directory('portfolio/profile')
                                    ->imageEditor()
                                    ->circleCropper()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->visibility('public')
                                    ->getUploadedFileNameForStorageUsing(fn ($file) => $file->hashName())
                                    ->afterStateHydrated(function ($component, $state) {
                                        if ($state && ! str_contains($state, '/')) {
                                            $component->state(['portfolio/profile/'.$state]);
                                        }
                                    }),
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('as')
                                    ->label('Profesi / Jabatan')
                                    ->placeholder('contoh: Web Developer')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('experience')
                                    ->label('Tahun Pengalaman')
                                    ->numeric()
                                    ->minValue(0)
                                    ->required(),
                            ])
                            ->columnSpan(1),
                        Section::make('Tentang Saya')
                            ->schema([
                                Textarea::make('bio')
                                    ->label('Bio / Deskripsi')
                                    ->required()
                                    ->rows(5)
                                    ->maxLength(65535),
                                TextInput::make('cv_url')
                                    ->label('Curriculum Vitae (CV)')
                                    ->url()
                                    ->placeholder('https://contoh.com/cv.pdf')
                                    ->maxLength(255)
                                    ->validationMessages([
                                        'url' => 'Masukkan URL yang valid.',
                                    ]),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                Section::make('Kontak')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('phone')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->required()
                                    ->maxLength(20),
                            ])
                            ->columns(2),
                        Textarea::make('address')
                            ->label('Alamat')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Media Sosial')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('github_url')
                                    ->label('GitHub URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->maxLength(255),
                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->maxLength(255),
                                TextInput::make('twitter_url')
                                    ->label('Twitter / X URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->maxLength(255),
                                TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->maxLength(255),
                            ])
                            ->columns(2),
                    ]),
            ])->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Profil')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Simpan referensi file lama untuk dihapus nanti
        $profile = ProfileModel::first();
        $oldFoto = $profile?->foto;
        $oldCv = $profile?->cv;

        // Extract filename saja untuk foto dan cv
        if (! empty($data['foto'])) {
            $data['foto'] = is_array($data['foto'])
                ? basename($data['foto'][array_key_first($data['foto'])] ?? '')
                : basename($data['foto']);
        }

        if (! empty($data['cv'])) {
            $data['cv'] = is_array($data['cv'])
                ? basename($data['cv'][array_key_first($data['cv'])] ?? '')
                : basename($data['cv']);
        }

        if ($profile) {
            $profile->update($data);
        } else {
            ProfileModel::create($data);
        }

        // Hapus file lama dari Cloudinary jika berbeda dengan file baru
        if ($oldFoto && $oldFoto !== $data['foto']) {
            $this->deleteFromCloudinary($oldFoto, 'profile');
        }

        if ($oldCv && $oldCv !== $data['cv']) {
            $this->deleteFromCloudinary($oldCv, 'profile');
        }

        Notification::make()
            ->title('Profil berhasil disimpan')
            ->success()
            ->send();
    }

    /**
     * Hapus file dari Cloudinary
     */
    protected function deleteFromCloudinary(?string $filename, string $folder = 'profile'): void
    {
        if (! $filename) {
            return;
        }

        try {
            $path = "portfolio/{$folder}/{$filename}";
            Storage::disk('cloudinary')->delete($path);
        } catch (\Exception $e) {
            // Log error tapi jangan gagalkan proses
            \Illuminate\Support\Facades\Log::warning("Failed to delete from Cloudinary: {$filename}", [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
