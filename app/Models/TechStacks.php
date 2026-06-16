<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStacks extends Model
{
    protected $table = 'tech_stacks';
    protected $fillable = [
        'name',
        'icon'
    ];

    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'project_tech_stack', 'tech_stack_id', 'project_id');
    }
}
