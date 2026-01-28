<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'url',
        'image',
    ];

    public function techStacks()
    {
        return $this->belongsToMany(TechStacks::class, 'pivot_project_tech_stack', 'project_id', 'tech_stack_id');
    }
}
