<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use App\LogActivityTrait;

class Projects extends Model
{
    use LogActivityTrait;
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'github_link',
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            try {
                Notification::make()
                    ->title('Project created!')
                    ->body('Project has been created successfully.')
                    ->success()
                    ->send();

                $model->logActivity('Created Project', 'membuat project baru : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed created project!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                
                \Log::error($e->getMessage());
            }
        });

        static::updated(function ($model) {
            try {
                Notification::make()
                    ->title('Project updated!')
                    ->body('Project has been updated successfully.')
                    ->success()
                    ->send();

                $model->logActivity('Updated Project', 'mengupdate project : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed updated!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                
                \Log::error($e->getMessage());
            }

            $model->logActivity('Updated Project', 'mengupdate project : ' . $model->name);
        });

        static::deleted(function ($model) {
            try {
                Notification::make()
                    ->title('Project deleted!')
                    ->body('Project has been deleted successfully.')
                    ->success()
                    ->send();

                $model->logActivity('Deleted Project', 'menghapus project : ' . $model->name);
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error, failed deleted project!')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
                \Log::error($e->getMessage());
            }
        });
    }

    // Relasi dengan Tech Stacks
    public function techStacks()
    {
        return $this->belongsToMany(TechStacks::class, 'project_tech_stack', 'project_id', 'tech_stack_id');
    }

    // Relasi dengan Specializations
    public function specializations()
    {
        return $this->belongsToMany(Specializations::class, 'project_specialization', 'project_id', 'specialization_id');
    }
}
