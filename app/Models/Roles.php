<?php

namespace App\Models;

use App\LogActivityTrait;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use LogActivityTrait;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Model Events
    protected static function booted()
    {
        static::created(function ($model) {
            try {
                Notification::make()
                    ->title('Role created!')
                    ->body('Role has been created successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Created Role', 'membuat role baru : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed created role!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::updated(function ($model) {
            try {
                Notification::make()
                    ->title('Role updated!')
                    ->body('Role has been updated successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Updated Role', 'mengupdate role : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed updated role!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::deleted(function ($model) {
            try {
                Notification::make()
                    ->title('Role deleted!')
                    ->body('Role has been deleted successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Deleted Role', 'menghapus role : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed deleted role!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });
    }

    // Relations
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'role_has_permissions', 'role_id', 'permission_id');
    }
}
