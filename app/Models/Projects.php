<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Projects extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'url',
        'image',
        'status',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Hapus gambar dari Cloudinary saat project dihapus
        static::deleting(function ($project) {
            if ($project->image) {
                try {
                    $path = "portfolio/projects/{$project->image}";
                    Storage::disk('cloudinary')->delete($path);
                } catch (\Exception $e) {
                    Log::warning("Failed to delete project image from Cloudinary: {$project->image}", [
                        'error' => $e->getMessage()
                    ]);
                }
            }
        });
    }

    public function techStacks()
    {
        return $this->belongsToMany(TechStacks::class, 'pivot_project_tech_stack', 'project_id', 'tech_stack_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skills::class, 'pivot_projects_skills', 'project_id', 'skill_id');
    }
}
