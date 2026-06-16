<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'github_link',
    ];

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
