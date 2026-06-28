<?php

namespace App\Models;

use App\LogActivityTrait;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class TechStacks extends Model
{
    use LogActivityTrait;
    protected $table = 'tech_stacks';
    protected $fillable = [
        'name',
        'icon'
    ];

    //Model Events
    protected static function booted() {
        static::created(function ($model) {
            try {
                Notification::make()
                    ->title('Tech Stack created!')
                    ->body('Tech Stack has been created successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Created Tech Stack', 'successfully created tech stack: ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed created tech stack!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::updated(function ($model) {
            try {
                Notification::make()
                    ->title('Tech Stack updated!')
                    ->body('Tech Stack has been updated successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Updated Tech Stack', 'successfully updated tech stack: ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed updated tech stack!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });

        static::deleted(function ($model) {
            try {
                Notification::make()
                    ->title('Tech Stack deleted!')
                    ->body('Tech Stack has been deleted successfully.')
                    ->success()
                    ->send();
                $model->logActivity('Deleted Tech Stack', 'successfully deleted tech stack: ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed deleted tech stack!')
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
        return $this->belongsToMany(Projects::class, 'project_tech_stack', 'tech_stack_id', 'project_id');
    }
}
