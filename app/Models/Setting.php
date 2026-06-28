<?php

namespace App\Models;

use App\LogActivityTrait;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use LogActivityTrait;
    protected $table = 'settings';

    protected $casts = [
        'app_logo' => 'array',
    ];

    protected $fillable = [
        'app_name',
        'app_name_short',
        'app_color',
        'app_logo',
        'app_favicon',
        'app_stempel',
        'app_background_login_image',
        'youtube_link',
        'instagram_link',
        'tiktok_link',
        'facebook_link',
        'x_twitter_link',
        'github_link',
        'linkedin_link',
    ];

    // Model Events
    protected static function booted() {
        static::created(function ($model) {
            try {
                Notification::make()
                    ->title('Setting created!')
                    ->body('Setting has been created successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Created Setting', 'successfully created setting: ' . $model->app_name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed created setting!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::updated(function ($model) {
            try {
                Notification::make()
                    ->title('Setting updated!')
                    ->body('Setting has been updated successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Updated Setting', 'successfully updated setting: ' . $model->app_name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed updated setting!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });
    }
}
