<?php

namespace App\Models;

use App\LogActivityTrait;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    use LogActivityTrait;
    protected $table = 'specializations';
    protected $fillable = [
        'name',
        'icon'
    ];

    //Model Events
    protected static function booted() {
        static::created(function ($model) {
            try {
                Notification::make()
                    ->title('Specialization created!')
                    ->body('Specialization has been created successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Created Specialization', 'membuat specialization baru : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed created specialization!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::updated(function ($model) {
            try {
                Notification::make()
                    ->title('Specialization updated!')
                    ->body('Specialization has been updated successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Updated Specialization', 'mengupdate specialization : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed updated specialization!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::deleted(function ($model) {
            try {
                Notification::make()
                    ->title('Specialization deleted!')
                    ->body('Specialization has been deleted successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Deleted Specialization', 'menghapus specialization : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed deleted specialization!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });
    }

    // Relations
    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'project_specialization', 'specialization_id', 'project_id');
    }
}
