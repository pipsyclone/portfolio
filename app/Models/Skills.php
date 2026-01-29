<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $table = 'skills';

    protected $fillable = [
        'name',
        'icon',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'pivot_profile_skills', 'skill_id', 'profile_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'pivot_projects_skills', 'skill_id', 'project_id');
    }
}
