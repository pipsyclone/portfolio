<?php

namespace App\Filament\Pages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

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
use Filament\Forms\Components\Textarea;

use Filament\Notifications\Notification;

class Profile extends Page
{
    protected string $view = 'filament.pages.profile';
    protected static ?string $title = 'Profil Pengguna';
    protected static ?string $slug = 'profile';

    // Sembunyikan dari sidebar
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];
    public function mount(): void
    {
        $user = User::first();
        $this->form->fill([
            'foto' => $user?->foto,
            'name' => $user?->name,
            'username' => $user?->username,
            'email' => $user?->email,
            'phone' => $user?->phone,
            'about' => $user?->about,
            'experience' => $user?->experience,
            'address' => $user?->address,
            'specialis' => $user?->specialis,
            'cv_file' => $user?->cv_file,
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
                    ->components([
                        Section::make()
                            ->schema([
                                FileUpload::make('foto')
                                    ->hiddenLabel()
                                    ->disk('public')
                                    ->directory('profile-photos')
                                    ->image()
                                    ->avatar()
                                    ->imageEditor()
                                    ->alignCenter()
                                    ->maxSize(2048)
                                    ->deleteUploadedFileUsing(function (string $file) {
                                        Storage::disk('public')->delete($file);
                                    }),
                            ]),
                        Section::make('Personal Information')
                            ->description('Update your profile information here.')
                            ->icon('heroicon-o-user')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required(),
                                Grid::make()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('email')
                                            ->label('Email Address')
                                            ->email()
                                            ->required(),
                                        TextInput::make('phone')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->required(),
                                    ]),
                            ]),
                        Section::make('Information')
                            ->icon('heroicon-o-user')
                            ->description('Landing page profile information.')
                            ->columnSpanFull()
                            ->schema([
                                Textarea::make('about')
                                    ->label('About')
                                    ->rows(6)
                                    ->columnSpanFull()
                                    ->required(),
                                Grid::make()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('experience')
                                            ->label('Experience (years)')
                                            ->numeric()
                                            ->required(),
                                        Textinput::make('address')
                                            ->label('Address')
                                            ->required(),
                                    ]),
                                Grid::make()
                                    ->columns(2)
                                    ->schema([
                                        Textinput::make('specialis')
                                            ->label('Specialis')
                                            ->required(),
                                        FileUpload::make('cv_file')
                                            ->label('Curriculum Vitae')
                                            ->disk('public')
                                            ->directory('cv')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->maxSize(10240)
                                            ->deleteUploadedFileUsing(function (string $file) {
                                                Storage::disk('public')->delete($file);
                                            }),
                                    ])
                            ]),
                        Section::make('Security')
                            ->description('You can update your password here. Leave it empty if you don\'t want to change the password.')
                            ->icon('heroicon-o-lock-closed')
                            ->columnSpanFull()
                            ->schema([
                                TextInput::make('current_password')
                                    ->label('Current Password')
                                    ->password()
                                    ->revealable()
                                    ->required(fn ($get) => filled($get('password')))
                                    ->currentPassword()
                                    ->dehydrated(false),
                                Grid::make()
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('password')
                                            ->label('Password')
                                            ->password()
                                            ->revealable()
                                            ->required(fn ($livewire) => $livewire instanceof CreateUser)
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->minLength(8),
                                        TextInput::make('password_confirmation')
                                            ->label('Confirm Password')
                                            ->password()
                                            ->revealable()
                                            ->required(fn ($get) => filled($get('password')))
                                            ->dehydrated(false)
                                            ->same('password'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->submit('save'),
        ];
    }

    public function save()
    {
        $data = $this->form->getState();
        $user = auth()->user();

        // Hash password baru
        if (!empty($data['password'])) {
             $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Jangan update password jika tidak diisi
        }

        $user->update($data);
        $user->createLog(request(), 'Updated Profile', 'Successfully updated profile information.');

        Notification::make()
            ->success()
            ->title('Profile updated successfully.')
            ->send();

        // Redirect kembali ke halaman profil setelah menyimpan
        $this->redirect(request()->header('Referer') ?? url()->current());
    }
}
