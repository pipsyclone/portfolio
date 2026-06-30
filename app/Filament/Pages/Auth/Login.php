<?php

namespace App\Filament\Pages\Auth;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;
use Filament\Auth\Pages\Login as BaseLogin;

use App\Models\ActivityLogs;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;

use Filament\Actions\Action;

use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class Login extends BaseLogin
{
    use HasCustomLayout;

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')
                ->label('Email')
                ->required()
                ->email()
                ->autocomplete()
                ->autofocus(),
            TextInput::make('password')
                ->label('Password')
                ->required()
                ->password()
                ->autocomplete()
                ->revealable(),
            ViewField::make('recaptcha')
                ->view('filament.components.recaptchav3')
                ->dehydrated(false),
        ]);
    }

    public ?string $captchaToken = '';
    public function setCaptchaToken(string $token): void
    {
        $this->captchaToken = $token;
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
    }

    public function authenticate(): LoginResponse
    {
        $token = $this->captchaToken;

        if (! $token) {
            Notification::make()
                ->title('Recaptcha verification failed. Please reload the page.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'data.email' => 'Recaptcha verification failed. Token not found.',
            ]);
        }

        $score = RecaptchaV3::verify($token, 'login');

        if ($score === false || $score < (float) config('recaptchav3.threshold', 0.5)) {
            $this->dispatch('reset-captcha');
            
            Notification::make()
                ->title('Recaptcha verification failed. Please try again.')
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'data.email' => 'Recaptcha verification failed.',
            ]);
        }

        $response = parent::authenticate();

        // Dipanggil hanya jika login berhasil
        $request = request();
        ActivityLogs::create([
            'user_id' => auth()->id(),
            'activity' => 'Sign In',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'description' => 'Sign In successfully as '.auth()->user()->name,
        ]);

        return $response;
    }

    protected function throwFailureValidationException(): never
    {
        $this->dispatch('reset-captcha');

        Notification::make()
            ->title('Invalid email or password.')
            ->danger()
            ->send();

        $data = $this->form->getState();
        $request = request();
        ActivityLogs::create([
            'user_id' => auth()->id(),
            'activity' => 'Sign In',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'description' => 'Failed to sign in as ' . $data['email'],
        ]);

        throw ValidationException::withMessages([
            'data.email' => 'Invalid email or password.',
        ]);
    }
}