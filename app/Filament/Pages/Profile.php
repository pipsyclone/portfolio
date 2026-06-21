<?php

namespace App\Filament\Pages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Components\Utilities\Get;

use App\Models\User;

use Filament\Pages\Page;
use BackedEnum;

// Form Components
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Actions\Action;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;

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
            'headline' => $user?->headline,
            'keywords' => $user?->keywords,
            'about_image' => $user?->about_image,
            'about_title' => $user?->about_title,
            'about_description' => $user?->about_description,
            'about_extra_information' => $user?->about_extra_information,
            'experience' => $user?->experience,
            'careers' => $user?->careers,
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
                        Tabs::make()
                            ->columnSpanFull()
                            ->tabs([
                                Tab::make('Hero / SEO')
                                    ->schema([
                                        Grid::make()
                                            ->columns(2)
                                            ->schema([
                                                TextInput::make('headline')
                                                    ->label('Headline'),
                                                Textinput::make('keywords')
                                                    ->label('Keywords')
                                                    ->placeholder('Frontend Developer, Backend Developer, Fullstack Developer, UI/UX Designer, Web Developer')
                                                    ->helperText('Separated by commas'),
                                                Textinput::make('specialis')
                                                    ->label('Specialis'),
                                            ]),
                                    ]),
                                Tab::make('About')
                                    ->schema([
                                        TextInput::make('experience')
                                            ->label('Experience (years)')
                                            ->numeric(),
                                        FileUpload::make('about_image')
                                            ->label('About Image')
                                            ->disk('public')
                                            ->directory('about-images')
                                            ->image()
                                            ->imageEditor()
                                            ->maxSize(2048)
                                            ->deleteUploadedFileUsing(function (string $file) {
                                                Storage::disk('public')->delete($file);
                                            }),
                                        TextInput::make('about_title')
                                            ->label('Title'),
                                        Textarea::make('about_description')
                                            ->label('Description')
                                            ->rows(6)
                                            ->columnSpanFull(),
                                        Repeater::make('about_extra_information')
                                            ->defaultItems(1)
                                            ->schema([
                                                TextInput::make('information')->label('Information')->required(),
                                            ])
                                    ]),
                                Tab::make('Careers')
                                    ->schema([
                                        Repeater::make('careers')
                                            ->defaultItems(1)
                                            ->reorderable()
                                            ->deleteAction(
                                                fn ($action) => $action->after(function (array $state) {
                                                    if (! empty($state['logo'])) {
                                                        Storage::disk('public')->delete($state['logo']);
                                                    }
                                                }),
                                            )
                                            ->schema([
                                                FileUpload::make('logo')
                                                    ->label('Logo')
                                                    ->disk('public')
                                                    ->directory('careers-logo')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->maxSize(2048)
                                                    ->deleteUploadedFileUsing(function (string $file) {
                                                        Storage::disk('public')->delete($file);
                                                    }),
                                                Grid::make()
                                                    ->columns(2)
                                                    ->schema([
                                                        TextInput::make('company')
                                                            ->label('Company')
                                                            ->required(),
                                                        TextInput::make('position')
                                                            ->label('Position')
                                                            ->required(),
                                                    ]),
                                                RichEditor::make('description')
                                                    ->label('Description')
                                                    ->toolbarButtons([
                                                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                                        ['undo', 'redo'],
                                                    ])
                                                    ->required(),
                                                Grid::make()
                                                    ->columns(2)
                                                    ->schema([
                                                        DatePicker::make('start_date')
                                                            ->label('Start Date')
                                                            ->required(),
                                                        Grid::make()
                                                            ->columns(1)
                                                            ->schema([
                                                                DatePicker::make('end_date')
                                                                    ->label('End Date')
                                                                    ->disabled(fn (Get $get) => $get('on_going')),
                                                                Checkbox::make('on_going')
                                                                    ->label('On Going')
                                                                    ->live()
                                                                    ->afterStateUpdated(function ($state, $set) {
                                                                        if ($state) {
                                                                            $set('end_date', null);
                                                                        }
                                                                    }),
                                                            ])
                                                    ])
                                            ])
                                    ]),
                                Tab::make('Contact')
                                    ->schema([
                                        Textinput::make('address')
                                            ->label('Address'),
                                    ]),
                                Tab::make('Files')
                                    ->schema([
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
                                    ]),
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
